import { Component, NgModule } from '@angular/core';
import { FormBuilder, FormGroup, NgForm, Validators } from '@angular/forms';
import { CommonModule } from '@angular/common';
import {FormsModule} from '@angular/forms';
import { FormControl, ReactiveFormsModule } from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router, RouterLink } from '@angular/router';
import { RegisterService } from '../../register.service';
import { CheckboxModule } from 'primeng/checkbox';

@Component({
  selector: 'app-signup',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, CheckboxModule, FormsModule, RouterLink],
  templateUrl: './signup.component.html',
  styleUrl: './signup.component.css'
})
export class SignupComponent {
  device_name: string = "Unknown";
  errors: any = [];

  constructor(private http: HttpClient, private router: Router) {}

onSubmit(myForm: NgForm) {
  const userAgent = navigator.userAgent;
  let device_name = '';

  if (/android/i.test(userAgent)) {
    device_name = "Android Device";
  } else if (/iPad|iPhone|iPod/.test(userAgent)) {
    device_name = "iOS Device";
  } else if (/Macintosh/.test(userAgent)) {
    device_name = "Mac";
  } else if (/Windows/.test(userAgent)) {
    device_name = "Windows PC";
  } else if (/Linux/.test(userAgent)) {
    device_name = "Linux PC";
  }

  const formData = { ...myForm.value, device_name };

  this.http.post('http://127.0.0.1:8000/api/user', formData)
    .subscribe(
      (response: any) => {
        console.log('Signup successful:', response);
        this.router.navigate(['/user/login'])
      },
      registerError => {
        // Extract errors from the registerError object
        const errorObject = registerError.error.errors;
        if (errorObject) {
          // Convert the error object into an array of error messages
          this.errors = Object.values(errorObject).flat();
        } else {
          this.errors = ['Registration failed'];
        }
      }
    );
}
}

