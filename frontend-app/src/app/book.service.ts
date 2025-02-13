import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
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
  getAllBooks(): Observable<any[]> {
    // return this.http.get<any[]>(this.apiUrl + '/book').pipe(
    //   map((response: any) => {
    //     return response.json();
    //   })
    // );
    return this.http.get<any[]>(`${this.apiUrl}/book`);
  }
}
