// cart.component.ts
import { Component, OnInit } from '@angular/core';
import { CommonModule, NgFor } from '@angular/common';
import { RouterLink } from '@angular/router';
import { CartService } from '../../services/cart.service';
import { AuthService } from '../../services/auth.service';

@Component({
  standalone: true,
  imports: [NgFor,CommonModule, RouterLink],
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {

  cartItems: { product: any; quantity: number }[] = [];
  totalprice: number = 0;
  shipping: number = 20;
  counter: number = 0;

  constructor(private cartService: CartService, private authService: AuthService) {
    this.updateTotalPrice();
  }

  auth() {
    return this.authService.isAuthenticated();
  }
  ngOnInit(): void {
    this.cartItems = this.cartService.getCart();
    this.updateTotalPrice();


  }

  private updateTotalPrice(): void {
    this.totalprice = this.cartService.getTotalPrice();
  }

  increaseQuantity(product: any): void {
    this.cartService.increaseQuantity(product);
    this.updateTotalPrice();
    this.cartItems = this.cartService.getCart();
  }

  decreaseQuantity(product: any): void {
    this.cartService.decreaseQuantity(product);
    this.updateTotalPrice();
    this.cartItems = this.cartService.getCart();
  }
  removeFromCart(product: any): void {
    this.cartService.removeFromCart(product);
    this.cartItems = this.cartService.getCart();
    this.updateTotalPrice();

  }
  getCountOfItems() {
    return this.cartService.getCountOfItems();
  }


  clearCart(): void {
    this.cartService.clearCart();
    this.updateTotalPrice();
    this.cartItems = this.cartService.getCart();

  }
}
