import { Component, OnInit } from '@angular/core';
import { CommonModule, NgClass, NgFor,NgIf, NgStyle } from '@angular/common';
import { ProductsService } from '../../services/products.service';
import { Product } from '../../interface/product';
import { CategoryService } from '../../category.service';
import { CatShowComponent } from '../cat-show/cat-show.component';
import { CardComponent } from '../card/card.component';
import { SidebarComponent } from '../sidebar/sidebar.component';
import { RouterLink } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
import { AuthService } from '../../services/auth.service';


@Component({
    standalone: true,
    selector: 'app-products',
    templateUrl: './products.component.html',
    styleUrl: './products.component.css',
    imports: [NgClass, NgStyle, NgFor, NgIf, CommonModule, SidebarComponent,CardComponent,CatShowComponent,RouterLink]
})
export class ProductsComponent implements OnInit {
  categories: any[] = [];
  title = 'Products';
  products: Product[] = [];
  isSeller: boolean = false;

  constructor(
    private productsService: ProductsService,
    private route: ActivatedRoute,
    private authService: AuthService
  ) {}

  ngOnInit() {
    this.authService.isSeller().then(isSeller => {
      this.isSeller = isSeller;
    });

    // Extract the ID from route parameters
    this.route.params.subscribe(params => {
      const categoryName = +params['cat']; // Assuming 'id' is the parameter name in your route
      this.getProductsList(categoryName);
    });
  }

  getProductsList(categoryId: number): void {
    this.productsService.getProductsList(categoryId).subscribe(
      (res: any) => {
        console.log(res);
        // Assuming the response structure is { products: [], total: number, skip: number, limit: number }
        if (res && res.products) {
          this.products = res.products;
          console.log(this.products);
        } else {
          console.error('No products found in the response.');
        }
      },
      error => {
        console.error('Error fetching products:', error);
      }
    );
  }

  trackById(index: number, item: any): number {
    return item.id;
  }

  receiveFromChild(id: string) {
    console.log('RECEIVED FROM CHILD, ID', id);
    // this.games = this.games.filter(game => game.id !== id)
  }

  
 }
