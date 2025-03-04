import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BookService } from './book.service';
import { environment } from 'src/environments/environment';
import { HttpResponse } from '@angular/common/http';
import { IListUserResponse } from '../shared/interfaces/list-user-response.interface';
import { TCreateUserProps } from '../shared/types/create-user-props.type copy';
import { Observable, catchError, map, of } from 'rxjs';
import { IHttpResponse } from '../shared/interfaces/http-response.interface';
import { IUserJwtResponse } from '../shared/interfaces/user-jwt-response.interface';
import { TUserLoginProps } from '../shared/types/user-login-props.type';
import { IBook } from '../shared/interfaces/book.interface';
@Injectable({
  providedIn: 'root',
})
export class UserService {
  apiUrl: any;
  constructor(private http: HttpClient, private bookService: BookService) {
    this.apiUrl = environment.apiUrl;
  }

  signup(props: TCreateUserProps): Observable<IListUserResponse> {
    return this.http.post<IListUserResponse>(`${this.apiUrl}/register`, props);
  }

  login(props: TUserLoginProps): Observable<boolean> {
    return this.http.post<IUserJwtResponse>(`${this.apiUrl}/login`, props).pipe(
      map((response) => {
        localStorage.setItem('JWT_Token', response.token);
        // console.log(response);
        return true;
      }),
      catchError((error) => {
        console.log(error);
        return of(false);
      })
    );
  }

  logout(): Observable<any> {
    return this.http.get<IUserJwtResponse>(`${this.apiUrl}/logout`);
  }

  me(): Observable<IUserJwtResponse> {
    return this.http.get<IUserJwtResponse>(`${this.apiUrl}/me`);
  }
}
