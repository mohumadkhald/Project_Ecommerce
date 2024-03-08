import { Component } from '@angular/core';
import { ProductsComponent } from '../products-show/products.component';

@Component({
  selector: 'app-cat-show',
  standalone: true,
  imports:[ProductsComponent],
  templateUrl: './cat-show.component.html',
  styleUrl: './cat-show.component.css'
})
export class CatShowComponent {

}
