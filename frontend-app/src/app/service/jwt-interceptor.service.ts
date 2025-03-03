import { Injectable } from '@angular/core';
import {
  HttpEvent,
  HttpHandler,
  HttpInterceptor,
  HttpRequest,
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { TokenService } from './token.service';
import { IUserJwtResponse } from '../shared/interfaces/user-jwt-response.interface';
import { IHttpResponse } from '../shared/interfaces/http-response.interface';

@Injectable({
  providedIn: 'root',
})
export class JwtInterceptorService implements HttpInterceptor {
  constructor(private tokenService: TokenService) {}
  intercept(
    request: HttpRequest<any>,
    next: HttpHandler
  ): Observable<HttpEvent<IHttpResponse>> {
    // if (request.url.includes('/login')) {
    //   return next.handle(request);
    // }
    const token = this.tokenService.get();
    if (token) {
      console.log(token);
      const authReq = request.clone({
        setHeaders: { Authorization: `Bearer ${token}` },
      });
      return next.handle(authReq);
    } else {
      return next.handle(request);
    }
  }
}
