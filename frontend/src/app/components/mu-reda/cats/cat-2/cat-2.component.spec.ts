import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cat2Component } from './cat-2.component';

describe('Cat2Component', () => {
  let component: Cat2Component;
  let fixture: ComponentFixture<Cat2Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [Cat2Component]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(Cat2Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
