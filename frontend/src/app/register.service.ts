import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class RegisterService {

  constructor(private http: HttpClient) { }
  signup(email: string, name:string, phone: number, device_name: string, gender: string, address:string, password: string,password_confirmation:string): Observable<any> {
    return this.http.post<any>('http://127.0.0.1:8000/api/register', { email,phone, device_name, gender, address,password,password_confirmation });
  }
}
