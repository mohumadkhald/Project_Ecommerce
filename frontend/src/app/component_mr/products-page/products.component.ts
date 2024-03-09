import { Component, OnInit } from '@angular/core';
import { CommonModule, NgClass, NgFor,NgIf, NgStyle } from '@angular/common';
import { ProductsService } from '../../services/products.service';
import { Product } from '../../interface/product';
import { CategoryService } from '../../category.service';
import { CatShowComponent } from '../cat-show/cat-show.component';
import { CardComponent } from '../card/card.component';
import { SidebarComponent } from '../sidebar/sidebar.component';


@Component({
    standalone: true,
    selector: 'app-products',
    templateUrl: './products.component.html',
    styleUrl: './products.component.css',
    imports: [NgClass, NgStyle, NgFor, NgIf, CommonModule, SidebarComponent,CardComponent,CatShowComponent]
})
export class ProductsComponent   {

  categories: any[] = [];

  title = 'Products';
  products !: Product[];

  constructor(private ProductsService : ProductsService){}

  ngOnInit(){
    this.ProductsService.getProductsList().subscribe((res: any) => {
      console.log(res.data);
      // Assuming the response structure is { products: [], total: number, skip: number, limit: number }
      if (res && res.data) {
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

  
 }
