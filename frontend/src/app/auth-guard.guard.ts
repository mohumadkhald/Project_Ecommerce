import { CanActivateFn } from '@angular/router';

export const authGuardGuard: CanActivateFn = (route, state) => {
  if(localStorage.getItem('token')) {
    return true;
  } else if(localStorage.getItem('')) {
    
  }
  state.url = '/login';
  return false;
};
