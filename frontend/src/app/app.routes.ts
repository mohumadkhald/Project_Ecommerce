import { Routes } from '@angular/router';
import { ProfileComponent } from './compon_mk/profile/profile.component';
import { PageDetailsComponent } from './compon_mk/page-details/page-details.component';
import { ProductsComponent } from './compon_mk/products/products.component';
import { LoginComponent } from './component_omar/login/login.component';
import { SignupComponent } from './component_omar/signup/signup.component';
import { ContactComponent } from './component_omar/contact/contact.component';
import { NotfoundComponent } from './compon_mk/notfound/notfound.component';
import { CartComponent } from './compon_mk/cart/cart.component';
import { MainPageComponent } from './component_mr/main-page/main-page.component';
import { AboutUsComponent } from './component_mr/about-us/about-us.component';

export const routes: Routes = [

    {path:'',component:MainPageComponent},
    { path: 'products', component: ProductsComponent ,title: "Home"},
    {path:'product/details/:id',component:PageDetailsComponent, title: "Product Details"},
    {path:'profile',component:ProfileComponent, title: "Profile"},
    { path: 'user/login', component: LoginComponent, title: "Login"},
    { path: 'products/cart',component: CartComponent, title: "Cart"},
    { path: 'user/signup', component: SignupComponent, title: "Sign Up"},
    { path: 'contact', component: ContactComponent, title: "Contact"},

    { path: 'about-us', component: AboutUsComponent, title: "About Us"},
    { path: 'notfound', component: NotfoundComponent, title: "Not Found"},
    { path: '**', redirectTo: '/notfound' }

];
