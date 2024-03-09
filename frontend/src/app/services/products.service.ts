import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  constructor(private http: HttpClient) { }

  getProductsList(categoryId: number): Observable<any> {
    return this.http.get(`http://127.0.0.1:8000/api/categories/${categoryId}/products`);
  }

  getProductsDetails(id : number){
    return this.http.get(`http://127.0.0.1:8000/api/brands/${id}`)
  }

}
