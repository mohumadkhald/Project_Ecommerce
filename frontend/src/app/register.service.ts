import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class RegisterService {

  constructor(private http: HttpClient) { }
  signup(email: string, name:string, phone_number: number, device_name: string, role: string, address:string, password: string,password_confirmation:string): Observable<any> {
    return this.http.post<any>('http://127.0.0.1:8000/api/user', { email,phone_number, device_name, role, address,password,password_confirmation });
  }
}
