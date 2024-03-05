import { Component } from '@angular/core';
import { HeaderComponent } from "../header/header.component";
import { SideBarComponent } from "../side-bar/side-bar.component";
import { SideBarSlidersComponent } from "../side-bar-sliders/side-bar-sliders.component";

@Component({
    selector: 'app-main-page',
    standalone: true,
    templateUrl: './main-page.component.html',
    styleUrl: './main-page.component.css',
    imports: [HeaderComponent, SideBarComponent, SideBarSlidersComponent]
})
export class MainPageComponent {

}
