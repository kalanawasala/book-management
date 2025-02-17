import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, of, throwError } from 'rxjs';
import { catchError, map, retry } from 'rxjs/operators';
import { Book } from '../assets/book';
import { environment } from 'src/environments/environment';
import { Data } from '@angular/router';

@Injectable({
  providedIn: 'root',
})
export class BookService {
  apiUrl: any;

  constructor(private http: HttpClient) {
    this.apiUrl = environment.apiUrl;
  }
  getAllBooks(): Observable<{
    success: boolean;
    message: string;
    data: Array<{ id: number; title: string }>;
  }> {
    return this.http.get<{
      success: boolean;
      message: string;
      data: Array<{ id: number; title: string }>;
    }>(`${this.apiUrl}/book`);
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

  addBooks(book: Book): Observable<{
    success: boolean;
    message: string;
    data: Array<{ id: number; title: string }>;
  }> {
    // const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    return this.http.post<{
      success: boolean;
      message: string;
      data: Array<{ id: number; title: string }>;
    }>(`${this.apiUrl}/book`, book);
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

  deleteBooks(bookId: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/book/${bookId}`);
  }

  searchedBook(term: string): Observable<{
    success: boolean;
    message: string;
    data: Array<{ id: number; title: string }>;
  }> {
    if (!term.trim()) {
      // if not search term, return empty book
      return of(<any>[]);
    }
    return this.http.get<any>(`${this.apiUrl}/book/?title=${term}`);
  }
}
