import { Component } from '@angular/core';
import { SideBarSlidersComponent } from '../side-bar-sliders/side-bar-sliders.component';
import { CommonModule } from '@angular/common';
import { Cat1Component } from '../cats/cat-1/cat-1.component';
import { Cat2Component } from '../cats/cat-2/cat-2.component';
import { Cat3Component } from '../cats/cat-3/cat-3.component';
import { Cat4Component } from '../cats/cat-4/cat-4.component';
import { Cat5Component } from '../cats/cat-5/cat-5.component';


@Component({
  selector: 'app-side-bar',
  standalone: true,
  imports: [SideBarSlidersComponent,CommonModule,Cat1Component,Cat2Component,Cat3Component,Cat4Component,Cat5Component],
  templateUrl: './side-bar.component.html',
  styleUrl: './side-bar.component.css'
})
export class SideBarComponent {

}
