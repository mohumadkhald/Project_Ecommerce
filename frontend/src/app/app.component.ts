import { AfterViewInit, Component, EventEmitter, OnChanges, OnInit } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { CommonModule } from '@angular/common';
import { NavbarComponent } from './component_mr/navbar/navbar.component';
import { FooterComponent } from './component_mr/footer/footer.component';
import { ProductsComponent } from './component_mr/products-page/products.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, RouterOutlet,NavbarComponent,FooterComponent,ProductsComponent
    ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent   {
  title = 'prinder';


}
