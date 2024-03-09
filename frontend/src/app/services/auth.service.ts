import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, map, tap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  constructor(private http: HttpClient) { }

  login(email: string, password: string, device_name: string): Observable<any> {
    return this.http.post<any>('http://127.0.0.1:8000/api/sanctum/token', { email, password, device_name });
  }

  logout() {
    // Remove token from local storage upon logout
    localStorage.removeItem('token');
  }

  isAuthenticated(): boolean {
    // Check if user is authenticated
    return !!localStorage.getItem('token');
  }
  getUserData(): Observable<any> {
    // Get token from local storage
    const token = localStorage.getItem('token');

    // Create headers with authorization token
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });

    // Send HTTP request with headers
    return this.http.get<any>('http://127.0.0.1:8000/api/user', { headers });
  }

  async isSeller(): Promise<boolean> {
    try {
      const user = await this.getUserData().toPromise();
      console.log(user);
      return user.role === 'seller';
    } catch (error) {
      console.error('Error:', error);
      return false; // Assume user is not a seller if there's an error
    }
  }

}