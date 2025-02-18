import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

import { IHttpResponse } from '../shared/interfaces/http-response.interface';
import { TCreateBookProps } from '../shared/types/create-book-props.type';
import { IListBooksResponse } from '../shared/interfaces/list-book-response.interface';

@Injectable({
  providedIn: 'root',
})
export class BookService {
  apiUrl: any;

  constructor(private http: HttpClient) {
    this.apiUrl = environment.apiUrl;
  }

  getAllBooks(): Observable<IListBooksResponse> {
    return this.http.get<IListBooksResponse>(`${this.apiUrl}/book`);
  }

  getBook(id: number): Observable<IListBooksResponse> {
    return this.http.get<IListBooksResponse>(`${this.apiUrl}/book/${id}`);
  }

  addBooks(props: TCreateBookProps): Observable<IHttpResponse> {
    return this.http.post<IHttpResponse>(`${this.apiUrl}/book`, props);
  }

  updateBook(id: number, book: object): Observable<IListBooksResponse> {
    return this.http.put<IListBooksResponse>(
      `${this.apiUrl}/book/${id}}`,
      book
    );
  }

  deleteBooks(bookId: number): Observable<IListBooksResponse> {
    return this.http.delete<IListBooksResponse>(
      `${this.apiUrl}/book/${bookId}`
    );
  }
}
