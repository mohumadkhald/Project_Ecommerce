// product.service.ts

import { Injectable } from '@angular/core';
import { Category } from '../models/category.model'

@Injectable({
  providedIn: 'root',
})
export class CategoryService{
  private categories: Category[] = [
    {
      name: "cat1",
  numberOfProducts: 55,
  image: '', // Assuming image is a URL
  description: "lorem ipsum dolor sit amet",
  productsId: 34,
    },
    {
      name: "cat1",
  numberOfProducts: 55,
  image: '', // Assuming image is a URL
  description: "lorem ipsum dolor sit amet",
  productsId: 34,
    },
    {
      name: "cat1",
  numberOfProducts: 55,
  image: '', // Assuming image is a URL
  description: "lorem ipsum dolor sit amet",
  productsId: 34,
    },
    {
      name: "cat1",
  numberOfProducts: 55,
  image: '', // Assuming image is a URL
  description: "lorem ipsum dolor sit amet",
  productsId: 34,
    },
    {
      name: "cat1",
  numberOfProducts: 55,
  image: '', // Assuming image is a URL
  description: "lorem ipsum dolor sit amet",
  productsId: 34,
    },
  ];

  getCategories(): Category[] {
    return this.categories;
  }
}
