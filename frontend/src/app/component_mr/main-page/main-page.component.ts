import { Component } from '@angular/core';
import { HeaderComponent } from '../header/header.component';
import { SidebarComponent } from '../sidebar/sidebar.component';
import { ProductsComponent } from '../products/products.component';

@Component({
  selector: 'app-main-page',
  standalone: true,
  imports:[HeaderComponent,SidebarComponent,SidebarComponent,ProductsComponent],
  templateUrl: './main-page.component.html',
  styleUrl: './main-page.component.css'
})
export class MainPageComponent {

}
