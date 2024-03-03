export interface Product {
    id: number;
    title: string;
    description:string;
    rating: number;
    price: Number;
    discountPercentage: Number;
    images: Array<string>;
    stock: number;
    thumbnail: string;
  }
  