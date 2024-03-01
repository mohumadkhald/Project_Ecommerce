import { Routes } from '@angular/router';
import { ProfileComponent } from './compon_mk/profile/profile.component';
import { MainPageComponent } from './components/mu-reda/main_page/main-page.component';
import { PageDetailsComponent } from './compon_mk/page-details/page-details.component';
import { NotfoundComponent } from './compon_mk/notfound/notfound.component';

export const routes: Routes = [

    {path:'',component:MainPageComponent},
    {path:'details',component:PageDetailsComponent},
    {path:'profile',component:ProfileComponent},
    { path: 'notfound', component: NotfoundComponent },
    { path: '**', redirectTo: '/notfound' }

];
//zain