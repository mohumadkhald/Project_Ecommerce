import { Component } from '@angular/core';
import { FormBuilder, FormGroup, NgForm, Validators } from '@angular/forms';
import { CommonModule } from '@angular/common';
import {FormsModule} from '@angular/forms';
import { FormControl, ReactiveFormsModule } from '@angular/forms';
import { CheckboxModule } from 'primeng/checkbox';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-login',
  standalone: true,
  imports: [ReactiveFormsModule,CommonModule,CheckboxModule, FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  device_name: string = "Unknown";
  errors: any = [];

  constructor(private authService: AuthService, private router: Router) { }

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
    this.authService.login(formData.email, formData.password, formData.device_name)
      .subscribe(
        response => {
          console.log('Login successful:', response);
          const loginResponse = response;

          // Add token to local storage
          localStorage.setItem('token', loginResponse);

          // Navigate or update UI based on response
          this.router.navigate(['user/profile'], { queryParams: { token: response } });
        },
        error => {
          console.error('Login failed:', error);
          this.errors = ['Login failed'];
        }
      );
  }

  logout() {
    this.authService.logout();
    this.router.navigate(['/']);
  }
}


