import { Component, NgModule } from '@angular/core';
import { FormBuilder, FormGroup, NgForm, Validators } from '@angular/forms';
import { CommonModule } from '@angular/common';
import {FormsModule} from '@angular/forms';
import { FormControl, ReactiveFormsModule } from '@angular/forms';
import { HttpHeaders } from '@angular/common/http';
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

  constructor(private signupService: RegisterService, private router: Router) { }

  onSubmit(myForm: NgForm) {
    const userAgent = navigator.userAgent;

    if (/android/i.test(userAgent)) {
      this.device_name = "Android Device";
    } else if (/iPad|iPhone|iPod/.test(userAgent)) {
      this.device_name = "iOS Device";
    } else if (/Macintosh/.test(userAgent)) {
      this.device_name = "Mac";
    } else if (/Windows/.test(userAgent)) {
      this.device_name = "Windows PC";
    } else if (/Linux/.test(userAgent)) {
      this.device_name = "Linux PC";
    }

    const formData = { ...myForm.value, device_name: this.device_name };
    console.log(formData);
    
    this.signupService.signup(formData.email, formData.name, formData.phone, formData.device_name, formData.gender, formData.addrees, formData.password,formData.password_confirmation)
      .subscribe(
        response => {
          console.log('Signup successful:', response);
          // Handle successful signup, e.g., navigate to a success page
        },
        error => {
          console.error('Signup failed:', error);
          this.errors = ['Signup failed'];
        }
      );
  }
}

