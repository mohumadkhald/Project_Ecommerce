import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Router } from '@angular/router';
import { CartService } from '../../services/cart.service';
import { CommonModule, NgClass, NgStyle, NgIf } from '@angular/common';
import { NgbRatingModule } from '@ng-bootstrap/ng-bootstrap';
import { StarRatingComponent } from '../star-rating/star-rating.component';

@Component({
  selector: 'app-card',
  standalone: true,
  imports: [CommonModule, NgClass, NgStyle, NgIf, StarRatingComponent, NgbRatingModule],
  templateUrl: './card.component.html',
  styleUrl: './card.component.css'
})
export class CardComponent {
  @Input() productItem : any ;
  @Output() sendToParent = new EventEmitter<number>();
  cartItems: { product: any; quantity: number }[] = [];

  constructor(private router: Router,private cartService: CartService) {}
  ngOnInit(): void {
    this.cartItems = this.cartService.getCart();
    
  }
  addToCart(product: any): void {
    this.cartService.addToCart(this.productItem);
  }
  redirectToDetails(id: number) {
    this.router.navigate([`product/details/${id}`], { 
     
    });
    
  }
}


