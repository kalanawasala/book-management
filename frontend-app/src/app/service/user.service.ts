import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BookService } from './book.service';
import { environment } from 'src/environments/environment';
import { HttpResponse } from '@angular/common/http';
import { IListUserResponse } from '../shared/interfaces/list-user-response.interface copy';
import { TCreateUserProps } from '../shared/types/create-user-props.type copy';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  apiUrl: any;
  constructor(private http: HttpClient, private bookService: BookService) {
    this.apiUrl = environment.apiUrl;
  }
}
