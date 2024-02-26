import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cat1Component } from './cat-1.component';

describe('Cat1Component', () => {
  let component: Cat1Component;
  let fixture: ComponentFixture<Cat1Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [Cat1Component]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(Cat1Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
