import { Routes } from '@angular/router';
import { ProfileComponent } from './compon_mk/profile/profile.component';
// import { NotFoundComponent } from './compon_mk/not_found /not-found.component';
import { MainPageComponent } from './components/mu-reda/main_page/main-page.component';
import { PageDetailsComponent } from './compon_mk/page-details/page-details.component';
import { LoginComponent } from './component_omar/login/login.component';
import { SignupComponent } from './component_omar/signup/signup.component';
import { ContactComponent } from './component_omar/contact/contact.component';

export const routes: Routes = [

    {path:'',component:MainPageComponent},
    {path:'details',component:PageDetailsComponent},
    {path:'profile',component:ProfileComponent},
    { path: 'login', component: LoginComponent },
    { path: 'signup', component: SignupComponent },
    { path: 'contact', component: ContactComponent },
    // { path: 'notfound', component: NotFoundComponent },
    // { path: '**', redirectTo: '/notfound' }

];
