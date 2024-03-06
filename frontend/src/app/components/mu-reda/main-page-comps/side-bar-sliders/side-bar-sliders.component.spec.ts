import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SideBarSlidersComponent } from './side-bar-sliders.component';

describe('SideBarSlidersComponent', () => {
  let component: SideBarSlidersComponent;
  let fixture: ComponentFixture<SideBarSlidersComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [SideBarSlidersComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(SideBarSlidersComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
