import { Component, OnInit } from '@angular/core';
import { HeaderComponent } from '../header/header.component';
import { SidebarComponent } from '../sidebar/sidebar.component';
import { CatShowComponent } from '../cat-show/cat-show.component';
import { ProductsComponent } from '../products-page/products.component';
import { CardComponent } from '../card/card.component';
import { Product } from '../../interface/product';
import { ProductsService } from '../../services/products.service';
import { NgFor } from '@angular/common';


@Component({
  selector: 'app-main-page',
  standalone: true,
  imports: [HeaderComponent, SidebarComponent, SidebarComponent, ProductsComponent, CatShowComponent, CardComponent, NgFor],
  templateUrl: './main-page.component.html',
  styleUrl: './main-page.component.css'
})
export class MainPageComponent implements OnInit {
  categories: any[] = [];

  title = 'Products';
  products !: Product[];

  constructor(private ProductsService: ProductsService) { }

  ngOnInit() {
    this.ProductsService.getProductsList().subscribe((res: any) => {
      console.log(res.data);
      // Assuming the response structure is { products: [], total: number, skip: number, limit: number }
      if (res && res.data) {
        this.products = res.data;
        // console.log(this.products);
      } else {
        console.error('No products found in the response.');
      }
    })
  }
  trackById(index: number, item: any): number {
    return item.id;
  }
  receiveFromChild(id: string) {
    console.log("RECEIVED FROM CHILD, ID", id)
    // this.games = this.games.filter(game => game.id !== id)
  }

}
