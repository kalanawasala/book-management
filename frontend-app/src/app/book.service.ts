import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, map, retry } from 'rxjs/operators';
import { Book } from './book';
import { environment } from 'src/environments/environment';

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
    // return this.http.get<any[]>(this.apiUrl + '/book').pipe(
    //   map((response: any) => {
    //     return response.json();
    //   })
    // );
    return this.http.get<{
      success: boolean;
      message: string;
      data: Array<{ id: number; title: string }>;
    }>(`${this.apiUrl}/book`);
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

  deleteBooks(bookId: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/book ${bookId}`);
  }
}
