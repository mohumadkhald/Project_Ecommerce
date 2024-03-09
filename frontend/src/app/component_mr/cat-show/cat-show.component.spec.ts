import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CatShowComponent } from './cat-show.component';

describe('CatShowComponent', () => {
  let component: CatShowComponent;
  let fixture: ComponentFixture<CatShowComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CatShowComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CatShowComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
