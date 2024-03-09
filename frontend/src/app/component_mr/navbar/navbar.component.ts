import { Component, OnInit } from '@angular/core';
import { Router, RouterLink, RouterLinkActive } from '@angular/router';
import { AuthService } from '../../services/auth.service';
import { NgIf } from '@angular/common';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [RouterLink, NgIf,RouterLinkActive],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css'
})
export class NavbarComponent implements OnInit {
  userData: any;
  ngOnInit() {
    this.getUserData();
  }

  getUserData() {
    // Retrieve token from localStorage
    const token = localStorage.getItem('token');

    // Make HTTP GET request to fetch user data
    this.http.get('http://127.0.0.1:8000/api/user', {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`
      })
    })
    .subscribe(
      (response: any) => {
        if(response){
          this.userData = response.user;
        }
        // Handle successful response
      },

    );
  }

  constructor(public authService: AuthService, private router: Router,private http: HttpClient) { }
  logout() {

    localStorage.removeItem('token');
    this.authService.logout();
    this.router.navigate(['/user/login']); // Assuming you have a login route

  }
  auth() {
    return this.authService.isAuthenticated();
  }
}
