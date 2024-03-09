import { Routes } from '@angular/router';
import { ProfileComponent } from './compon_mk/profile/profile.component';
import { PageDetailsComponent } from './compon_mk/page-details/page-details.component';
import { LoginComponent } from './component_mr/login/login.component';
import { SignupComponent } from './component_mr/signup/signup.component';
import { ContactComponent } from './component_mr/contact/contact.component';
import { NotfoundComponent } from './compon_mk/notfound/notfound.component';
import { CartComponent } from './compon_mk/cart/cart.component';
import { MainPageComponent } from './component_mr/main-page/main-page.component';
import { AboutUsComponent } from './component_mr/about-us/about-us.component';
import { authGuardGuard } from './auth-guard.guard';
import { ProductsComponent } from './component_mr/products-page/products.component';
import { AddProductPageComponent } from './component_mr/add-product-page/add-product-page.component';

export const routes: Routes = [

    {path:'',component:MainPageComponent,title: "prinder",},
    { path:'products/:cat', component: ProductsComponent ,title: "shop"  },
    {path:'product/details/:id',component:PageDetailsComponent, title: "Product Details"},
    {path:'user/profile',component:ProfileComponent, title: "Profile", canActivate: [authGuardGuard]},
    { path: 'user/login', component: LoginComponent, title: "Login"},
    { path: 'cart',component: CartComponent, title: "Cart"},
    { path: 'user/signup', component: SignupComponent, title: "Sign Up"},
    { path: 'contact', component: ContactComponent, title: "Contact"},
    { path: 'about-us', component: AboutUsComponent, title: "About Us"},
    { path: 'notfound', component: NotfoundComponent, title: "Not Found"},
    { path: 'add-product', component: AddProductPageComponent, title: "add Product"},

    { path: '**', redirectTo: '/notfound' }

];
