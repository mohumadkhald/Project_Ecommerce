import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cat3Component } from './cat-3.component';

describe('Cat3Component', () => {
  let component: Cat3Component;
  let fixture: ComponentFixture<Cat3Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [Cat3Component]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(Cat3Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
