import {
  CanActivateFn,
  ActivatedRouteSnapshot,
  Router,
  RouterStateSnapshot,
} from '@angular/router';
import { Injectable, Inject, inject } from '@angular/core';

import { Observable } from 'rxjs';
import { map, take } from 'rxjs/operators';
import { AuthService } from '../service/auth.service';

export const authGuard: CanActivateFn = (
  route: ActivatedRouteSnapshot,
  state: RouterStateSnapshot
) => {
  const authService = inject(AuthService);
  const router = inject(Router);

  return authService.isUserLoggedIn.pipe(
    take(1),
    map((isUserLoggedIn: boolean) => {
      if (!isUserLoggedIn) {
        router.navigate(['/login']);
        return false;
      }
      return true;
    })
  );
};
