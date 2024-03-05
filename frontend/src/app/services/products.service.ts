import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  constructor(private http: HttpClient) { }

  getProductsList(){
    return this.http.get('https://dummyjson.com/products' , {
      params: {
        name : 'super'
      },
      headers: {
        'Autherization': 'TOKEN'
      }
    })
  }

  getProductsDetails(id : number){
    return this.http.get(`https://dummyjson.com/products/${id}`)
  }

}