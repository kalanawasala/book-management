import { Injectable } from '@angular/core';
import { TokenService } from './token.service';
import { BehaviorSubject } from 'rxjs';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private loggedIn = new BehaviorSubject<boolean>(this.tokenService.loggedIn());
  authStatus = this.loggedIn.asObservable();

  changeAuthStatus(value: boolean) {
    this.loggedIn.next(value);
    this.tokenService.remove();
    this.router.navigate(['/']);
  }
  get isUserLoggedIn() {
    return this.loggedIn.asObservable();
  }

  constructor(private tokenService: TokenService, private router: Router) {}
}
