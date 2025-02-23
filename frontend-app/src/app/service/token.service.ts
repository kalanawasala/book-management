import { Injectable } from '@angular/core';
import { IUserJwtResponse } from '../shared/interfaces/user-jwt-response.interface';

@Injectable({
  providedIn: 'root',
})
export class TokenService {
  constructor() {}
  handle(token: IUserJwtResponse) {
    this.set(token);
  }
  set(token: IUserJwtResponse) {
    return localStorage.setItem('localToken', token.token);
  }

  get() {
    return localStorage.getItem('localToken');
  }

  remove() {
    return localStorage.removeItem('localToken');
  }

  isValid() {
    const token = this.get();
    if (token) {
      const payload = this.payload(token);
      if (payload) {
        return payload.iss === 'http://127.0.0.1:8000/api/login' ? true : false;
      }
    }
    return false;
  }

  payload(token: any) {
    const payload = token.split('.')[1];
    return payload;
    // return this.decode(payload);
  }

  // decode(payload: IUserJwtResponse) {
  //   return JSON.parse(atob(payload));
  // }

  loggedIn() {
    return this.isValid();
  }
}
