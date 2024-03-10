import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient) { }

  getHeaders(): HttpHeaders {
    const token = localStorage.getItem('token');
    return new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });
  }

  getProductsList(categoryId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/categories/${categoryId}/products`, { headers: this.getHeaders() });
  }

  getProductsDetails(id: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/brands/${id}`, { headers: this.getHeaders() });
  }

  getLatest(): Observable<any> {
    return this.http.get(`${this.apiUrl}/products`, { headers: this.getHeaders() });
  }
}
