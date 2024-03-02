import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cat5Component } from './cat-5.component';

describe('Cat5Component', () => {
  let component: Cat5Component;
  let fixture: ComponentFixture<Cat5Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [Cat5Component]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(Cat5Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
