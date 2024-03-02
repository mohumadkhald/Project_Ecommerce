import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { HeaderComponent } from '../main-page-comps/header/header.component';
import { NavbarComponent } from '../main-page-comps/navbar/navbar.component';
import { SideBarComponent } from '../main-page-comps/side-bar/side-bar.component';
import { SideBarSlidersComponent } from '../main-page-comps/side-bar-sliders/side-bar-sliders.component';
import { FooterComponent } from '../main-page-comps/footer/footer.component';

@Component({
  selector: 'app-main-page',
  standalone: true,
  imports: [RouterOutlet,HeaderComponent,FooterComponent,SideBarComponent,NavbarComponent,SideBarSlidersComponent],
  templateUrl: './main-page.component.html',
  styleUrl: './main-page.component.css'
})
export class MainPageComponent {

}
