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

    {path:'',component:MainPageComponent,title: "prinder",canActivate: [authGuardGuard]},
    { path:'products/:cat', component: ProductsComponent ,title: "shop",canActivate: [authGuardGuard]  },
    {path:'product/details/:id',component:PageDetailsComponent, title: "Product Details",canActivate: [authGuardGuard]},
    {path:'user/profile',component:ProfileComponent, title: "Profile", canActivate: [authGuardGuard]},
    { path: 'user/login', component: LoginComponent, title: "Login"},
    { path: 'cart',component: CartComponent, title: "Cart",canActivate: [authGuardGuard]},
    { path: 'user/signup', component: SignupComponent, title: "Sign Up"},
    { path: 'contact', component: ContactComponent, title: "Contact",canActivate: [authGuardGuard]},
    { path: 'about-us', component: AboutUsComponent, title: "About Us",canActivate: [authGuardGuard]},
    { path: 'notfound', component: NotfoundComponent, title: "Not Found",canActivate: [authGuardGuard]},
    { path: 'add-product', component: AddProductPageComponent, title: "add Product",canActivate: [authGuardGuard]},

    { path: '**', redirectTo: '/notfound' }

];
