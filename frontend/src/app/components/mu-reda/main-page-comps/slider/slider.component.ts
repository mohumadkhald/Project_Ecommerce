
import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../_services/product.service';
import {Product}from'../../models/product.model';
import { CommonModule } from '@angular/common';
import { CategoryService} from '../../_services/category.service';
import { Category } from '../../models/category.model';

@Component({
  selector: 'app-slider',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './slider.component.html',
  styleUrl: './slider.component.css'
})
export class SliderComponent implements OnInit {

  products: Product[] = [];
  categories: Category[] = [];

index: number=1
  constructor(private productService: ProductService, private categoryService: CategoryService) {}

  ngOnInit(): void {
    // Initialize data when the component is created
    this.products = this.productService.getProducts();
    this.categories = this.categoryService.getCategories();
  }



}




