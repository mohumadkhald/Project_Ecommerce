import { Component } from '@angular/core';
import { SideBarSlidersComponent } from '../side-bar-sliders/side-bar-sliders.component';
import { CommonModule } from '@angular/common';


@Component({
  selector: 'app-side-bar',
  standalone: true,
  imports: [SideBarSlidersComponent,CommonModule],
  templateUrl: './side-bar.component.html',
  styleUrl: './side-bar.component.css'
})
export class SideBarComponent {

}
