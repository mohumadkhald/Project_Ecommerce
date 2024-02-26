import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { HeaderComponent } from './components/mu-reda/header/header.component';
import { NavbarComponent } from './components/mu-reda/navbar/navbar.component';
import { SideBarComponent } from './components/mu-reda/side-bar/side-bar.component';
import { SideBarSlidersComponent } from './components/mu-reda/side-bar-sliders/side-bar-sliders.component';
import { FooterComponent } from './components/mu-reda/footer/footer.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, HeaderComponent,NavbarComponent,SideBarComponent,SideBarSlidersComponent,FooterComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'prinder';
}
