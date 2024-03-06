// product.service.ts

import { Injectable } from '@angular/core';
import { Product } from '../models/product.model'

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private products: Product[] = [
    {
      id: 1,
      name: 'Product 1',
      price: 19.99,
      image: '../../../../assets/1.png',
      description: "Description for Producd 1" ,
      category: 'Category A',
    },
    {
      id: 2,

      name: 'Product 2',
      price: 29.99,
      image: '../../../../assets/2.png',
      description: 'Description for Product 2',
      category: 'Category B',
    },
    {
      id: 3,

      name: 'Product 2',
      price: 29.99,
      image: '../../../../assets/3.png',
      description: 'Description for Product 2',
      category: 'Category B',
    },
    {
      id: 4,

      name: 'Product 2',
      price: 29.99,
      image: '../../../../assets/4.png',
      description: 'Description for Product 2',
      category: 'Category B',
    },
    {
      id: 5,
      name: 'Product 2',
      price: 29.99,
      image: '../../../../assets/5.png',
      description: 'Description for Product 2',
      category: 'Category B',
    },
    {
      id: 1,

      name: 'Product 2',
      price: 29.99,
      image: '../../../../assets/1.png',
      description: 'Description for Product 2',
      category: 'Category B',
    },
    {
      id: 1,

      name: 'Product 2',
      price: 29.99,
      image: '../../../../assets/2.png',
      description: 'Description for Product 2',
      category: 'Category B',
    },
    // Add more products as needed
  ];

  getProducts(): Product[] {
    return this.products;
  }
}
