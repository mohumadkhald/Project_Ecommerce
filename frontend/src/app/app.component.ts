import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { CommonModule } from '@angular/common';
import { NavbarComponent } from './components/mu-reda/main-page-comps/navbar/navbar.component';
import { MainPageComponent } from './components/mu-reda/main_page/main-page.component';
import { FooterComponent } from './components/mu-reda/main-page-comps/footer/footer.component';

@Component({
  selector: 'app-root',
  standalone: true,

  imports: [CommonModule, RouterOutlet, NavbarComponent, MainPageComponent, FooterComponent],

  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'prinder';
}
