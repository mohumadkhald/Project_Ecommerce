import { Component } from '@angular/core';
import { Router, RouterLink } from '@angular/router';
import { AuthService } from '../../services/auth.service';
import { NgIf } from '@angular/common';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [RouterLink, NgIf],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css'
})
export class NavbarComponent {
  constructor(public authService: AuthService, private router: Router) { }
  logout() {
    this.authService.logout();
    this.router.navigate(['/user/login']); // Assuming you have a login route
  }
  auth() {
    return this.authService.isAuthenticated(); 
  }
}
