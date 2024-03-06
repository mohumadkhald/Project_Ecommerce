import { Component, OnInit } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { CommonModule } from '@angular/common';
import { NavbarComponent } from './component_mr/navbar/navbar.component';
import { FooterComponent } from './component_mr/footer/footer.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, RouterOutlet,NavbarComponent,FooterComponent
    ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent implements OnInit {
  title = 'prinder';
  ngOnInit(): void {
    jQuery(document).ready(function(){
      jQuery('#myCarousel').carousel({
        interval: 3000,
      })
    });
  }
}
