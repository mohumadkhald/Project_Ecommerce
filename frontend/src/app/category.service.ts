import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, of } from 'rxjs';
import { Observable } from 'rxjs/internal/Observable';

@Injectable({
  providedIn: 'root'
})
export class CategoryService {
  private apiUrl = 'http://127.0.0.1:8000/api/categories/index';

  constructor(private http: HttpClient) {}

  getCategories(): Observable<any> {
    // Retrieve the value from local storage
    const token = localStorage.getItem('token');

    // Check if token exists
    if (!token) {
      console.error('Token not found in local storage');
      // Return an empty array as an observable
      return of([]);
    }

    // Create headers object with authorization token
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });

    // Make the HTTP request with the headers
    return this.http.get<any>(this.apiUrl, { headers }).pipe(
      catchError(error => {
        console.error('Error fetching categories:', error);
        // Return an empty array as an observable
        return of([]);
      })
    );
  }
}
