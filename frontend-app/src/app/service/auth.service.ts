import { Injectable } from '@angular/core';
import { TokenService } from './token.service';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private loggedIn = new BehaviorSubject<boolean>(this.tokenService.loggedIn());
  authStatus = this.loggedIn.asObservable();

  changeAuthStatus(value: boolean) {
    this.loggedIn.next(value);
  }
  constructor(private tokenService: TokenService) {}
}
