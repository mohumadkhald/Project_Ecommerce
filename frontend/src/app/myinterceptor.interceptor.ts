import { HttpInterceptor, HttpRequest, HttpHandler, HttpEvent } from '@angular/common/http';
import { Observable } from 'rxjs';

export class MyInterceptor implements HttpInterceptor {
  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    // Clone the request and set the necessary headers
    const modifiedRequest = request.clone({
      setHeaders: {
        'Content-Type': 'application/json', // Example header
        'Authorization': `Bearer ${localStorage.getItem('token')}` // Example header with token
      }
    });

    // Pass the modified request on to the next handler
    return next.handle(modifiedRequest);
  }
}
