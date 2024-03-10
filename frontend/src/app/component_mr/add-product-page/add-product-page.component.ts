import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, ViewChild } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-add-product-page',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './add-product-page.component.html',
  styleUrl: './add-product-page.component.css'
})
export class AddProductPageComponent {
  formData = {
    title: '',
    description: '',
    quantity: 0,
    price: 0,
    category_id: '',
  };
  
  @ViewChild('imageInput') imageInput: any;

  constructor(private http: HttpClient) { }

  submitForm(): void {
    const token = localStorage.getItem('token');
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });

    const formData = new FormData();
    formData.append('title', this.formData.title);
    formData.append('description', this.formData.description);
    formData.append('quantity', this.formData.quantity.toString());
    formData.append('price', this.formData.price.toString());
    formData.append('category_id', this.formData.category_id);
    // formData.append('id', this.formData.id);
    formData.append('image', this.imageInput.nativeElement.files[0]);

    this.http.post('http://127.0.0.1:8000/api/products/', formData, { headers })
      .subscribe(
        response => {
          console.log('Product posted successfully:', response);
          // Reset form after successful submission if needed
          this.resetForm();
        },
        error => {
          console.error('Error posting product:', error);
          console.log(this.formData);
        }
      );
  }

  resetForm(): void {
    this.formData = {
      title: '',
      description: '',
      quantity: 0,
      price: 0,
      category_id: '',
    };
    // Reset file input
    this.imageInput.nativeElement.value = '';
  }
}
