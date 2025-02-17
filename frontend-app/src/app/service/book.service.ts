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
  book = new Observable<any>();
  apiUrl: any;

  constructor(private http: HttpClient) {
    this.apiUrl = environment.apiUrl;
  }

  getAllBooks(): Observable<IListBooksResponse> {
    return this.http.get<IListBooksResponse>(`${this.apiUrl}/book`);
  }

  getBook(id: number): Observable<{
    success: boolean;
    message: string;
    data: Array<{ id: number; title: string }>;
  }> {
    return this.http.get<{
      success: boolean;
      message: string;
      data: Array<{ id: number; title: string }>;
    }>(`${this.apiUrl}/book/${id}`);
  }

  addBooks(props: TCreateBookProps): Observable<IHttpResponse> {
    return this.http.post<IHttpResponse>(`${this.apiUrl}/book`, props);
  }

  updateBook(
    id: number,
    book: object
  ): Observable<{
    success: boolean;
    message: string;
    data: Array<{ id: number; title: string }>;
  }> {
    return this.http.put<{
      success: boolean;
      message: string;
      data: Array<{ id: number; title: string }>;
    }>(`${this.apiUrl}/book/${id}}`, book);
  }

  deleteBooks(bookId: number): Observable<{
    success: boolean;
    message: string;
    data: Array<{ id: number; title: string }>;
  }> {
    return this.http.delete<{
      success: boolean;
      message: string;
      data: Array<{ id: number; title: string }>;
    }>(`${this.apiUrl}/book/${bookId}`);
  }

  searchedBook(term: string): Observable<{
    success: boolean;
    message: string;
    data: Array<{ id: number; title: string }>;
  }> {
    if (!term.trim()) {
      // if not search term, return empty hero array.
      return <any>[];
    }
    return this.http.get<{
      success: boolean;
      message: string;
      data: Array<{ id: number; title: string }>;
    }>(`${this.apiUrl}/book`);
  }
}
