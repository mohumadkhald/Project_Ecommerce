import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProductsCatsComponent } from './products-cats.component';

describe('ProductsCatsComponent', () => {
  let component: ProductsCatsComponent;
  let fixture: ComponentFixture<ProductsCatsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ProductsCatsComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ProductsCatsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
