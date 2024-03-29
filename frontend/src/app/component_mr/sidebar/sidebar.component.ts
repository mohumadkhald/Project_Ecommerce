import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';
import { CategoryService } from '../../category.service';
import { NgFor, NgIf } from '@angular/common';
import { Router, RouterLink } from '@angular/router';

@Component({
  selector: 'app-sidebar',
  standalone: true,
  imports: [NgIf, NgFor,RouterLink],
  templateUrl: './sidebar.component.html',
  styleUrl: './sidebar.component.css'
})
export class SidebarComponent {
  categories: any[] = [];

  constructor(private categoryService: CategoryService, private router:Router) {}

  ngOnInit(): void {
    this.fetchCategories();
  }

  fetchCategories(): void {
    this.categoryService.getCategories().subscribe(
      data => {
        this.categories = data.data;
      },
      error => {
        console.error('Error fetching categories:', error);
      }
    );
  }

  redirectToProducts(id: number) {
    this.router.navigate([`products/${id}`], { 
     
    });
    
  }

}
