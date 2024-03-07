import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, tap } from 'rxjs';

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
}