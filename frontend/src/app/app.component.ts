import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { HeaderComponent } from './components/mu-reda/header/header.component';
import { NavbarComponent } from './components/mu-reda/navbar/navbar.component';
import { SideBarComponent } from './components/mu-reda/side-bar/side-bar.component';
import { SideBarSlidersComponent } from './components/mu-reda/side-bar-sliders/side-bar-sliders.component';
import { FooterComponent } from './components/mu-reda/footer/footer.component';
import { CommonModule } from '@angular/common';
import { MainPageComponent } from './components/mu-reda/main_page/main-page.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, RouterOutlet,NavbarComponent, MainPageComponent,FooterComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'prinder';
}
