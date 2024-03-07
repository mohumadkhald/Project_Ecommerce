import { ApplicationConfig } from '@angular/core';
import {
  provideRouter,
  withComponentInputBinding,
  withViewTransitions,
} from '@angular/router';

import { routes } from './app.routes';
import { provideHttpClient, withFetch, withInterceptors } from '@angular/common/http';
import { DatePipe } from '@angular/common';
import { provideAnimations } from '@angular/platform-browser/animations';
import { MyInterceptor } from './myinterceptor.interceptor';

export const appConfig: ApplicationConfig = {
  
  providers: [
    provideRouter(routes, withComponentInputBinding(), withViewTransitions()),
    provideHttpClient(withFetch()),
    DatePipe,
    provideAnimations(),
    MyInterceptor, // Provide the interceptor directly
  ],
};
