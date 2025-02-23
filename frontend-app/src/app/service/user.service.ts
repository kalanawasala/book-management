import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BookService } from './book.service';
import { environment } from 'src/environments/environment';
import { HttpResponse } from '@angular/common/http';
import { IListUserResponse } from '../shared/interfaces/list-user-response.interface copy';
import { TCreateUserProps } from '../shared/types/create-user-props.type copy';
import { Observable } from 'rxjs';
import { IHttpResponse } from '../shared/interfaces/http-response.interface';
import { IUserJwtResponse } from '../shared/interfaces/user-jwt-response.interface';
import { IUser } from '../shared/interfaces/user.interface';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  apiUrl: any;
  constructor(private http: HttpClient, private bookService: BookService) {
    this.apiUrl = environment.apiUrl;
  }

  login(props: any): Observable<IUserJwtResponse> {
    return this.http.post<IUserJwtResponse>(`${this.apiUrl}/login`, props);
  }
}
