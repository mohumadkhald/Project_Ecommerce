import { Component } from '@angular/core';
import { HeaderComponent } from '../header/header.component';
import { SidebarComponent } from '../sidebar/sidebar.component';
import { CatShowComponent } from '../cat-show/cat-show.component';
import { ProductsComponent } from '../products-page/products.component';
import { CardComponent } from '../card/card.component';

@Component({
  selector: 'app-main-page',
  standalone: true,
  imports:[HeaderComponent,SidebarComponent,SidebarComponent,ProductsComponent,CatShowComponent,CardComponent],
  templateUrl: './main-page.component.html',
  styleUrl: './main-page.component.css'
})
export class MainPageComponent {

}
