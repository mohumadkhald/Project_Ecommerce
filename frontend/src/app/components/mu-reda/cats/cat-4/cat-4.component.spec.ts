import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cat4Component } from './cat-4.component';

describe('Cat4Component', () => {
  let component: Cat4Component;
  let fixture: ComponentFixture<Cat4Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [Cat4Component]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(Cat4Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
