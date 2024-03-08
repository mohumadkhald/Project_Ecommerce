import { Component, OnInit } from '@angular/core';
import { CommonModule, NgClass, NgFor,NgIf, NgStyle } from '@angular/common';
import { ProductsService } from '../../services/products.service';
import { Product } from '../../interface/product';
import { CardComponent } from '../card/card.component';
import { CategoryService } from '../../category.service';
import { CatShowComponent } from '../cat-show/cat-show.component';




@Component({
    standalone: true,
    selector: 'app-products',
    templateUrl: './products.component.html',
    styleUrl: './products.component.css',
    imports: [NgClass, NgStyle, NgFor, NgIf, CardComponent, CommonModule, CardComponent,CatShowComponent]
})
export class ProductsComponent implements OnInit {

  categories: any[] = [];








  title = 'Products';
  products !: Product[];

  constructor(private ProductsService : ProductsService,private categoryService: CategoryService){}

  ngOnInit(){
    this.fetchCategories();


    this.ProductsService.getProductsList().subscribe((res: any) => {
      // Assuming the response structure is { products: [], total: number, skip: number, limit: number }
      console.log(res.data);
      if (res && res.data && res.data.length > 0) {
        this.products = res.data;
        console.log(this.products);
      } else {
        console.error('No products found in the response.');
      }
    })
  }
  trackById(index: number, item: any): number {
    return item.id;
  }
  receiveFromChild(id : string){
    console.log("RECEIVED FROM CHILD, ID" , id)
    // this.games = this.games.filter(game => game.id !== id)
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

 }
