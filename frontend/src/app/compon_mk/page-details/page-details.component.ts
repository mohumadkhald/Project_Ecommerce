import { Product } from './../../interface/product';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-page-details',
  standalone: true,
  imports: [],
  templateUrl: './page-details.component.html',
  styleUrl: './page-details.component.css'
})
export class PageDetailsComponent implements OnInit {
  details:any = {};
  product: any = {};
  constructor(private http: HttpClient, private route: ActivatedRoute) { }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      const id = +params['id']; // Assuming 'id' is the parameter name in your route
      
      const headers = new HttpHeaders({
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      });
  
      this.http.get(`http://127.0.0.1:8000/api/products/${id}`, { headers })
        .subscribe(
          (response) => {
            // Handle response data here
            this.details = response
            this.product = this.details.data;
            console.log(this.product);
          },
          (error) => {
            console.error('Error:', error);
            // Handle error here
          }
        );
    }); 
  }

}
