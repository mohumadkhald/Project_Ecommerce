import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
<<<<<<< HEAD
import { MainPageComponent } from './components/mu-reda/main-page/main-page.component';
import { HeaderComponent } from './components/mu-reda/main-page-comps/header/header.component';
=======
import { HeaderComponent } from './components/mu-reda/header/header.component';
import { NavbarComponent } from './components/mu-reda/navbar/navbar.component';
import { SideBarComponent } from './components/mu-reda/side-bar/side-bar.component';
import { SideBarSlidersComponent } from './components/mu-reda/side-bar-sliders/side-bar-sliders.component';
import { FooterComponent } from './components/mu-reda/footer/footer.component';
import { CommonModule } from '@angular/common';
import { MainPageComponent } from './components/mu-reda/main_page/main-page.component';
>>>>>>> main

@Component({
  selector: 'app-root',
  standalone: true,
<<<<<<< HEAD
  imports: [RouterOutlet, MainPageComponent,HeaderComponent],
=======
  imports: [CommonModule, RouterOutlet,NavbarComponent, MainPageComponent,FooterComponent],
>>>>>>> main
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'prinder';
}
