import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-profile',
  standalone: true,
  imports: [],
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent implements OnInit {
  userData: any;
  errors: any = [];


  constructor(private http: HttpClient) { }

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
        // Handle successful response
        this.userData = response;
      },
      error => {
        // Handle error
        console.error('Error fetching user data:', error);
        this.errors = ['Login failed'];
      }
    );
  }
}