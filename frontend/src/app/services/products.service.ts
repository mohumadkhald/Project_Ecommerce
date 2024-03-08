import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  constructor(private http: HttpClient) { }

  getProductsList(){
    return this.http.get('http://127.0.0.1:8000/api/categories/index')
  }

  getProductsDetails(id : number){
    return this.http.get(`http://127.0.0.1:8000/api/brands/${id}`)
  }

}
