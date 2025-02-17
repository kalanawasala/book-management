import { Component } from '@angular/core';
import { BookService } from '../service/book.service';
import { HttpErrorResponse } from '@angular/common/http';
import { IBook } from '../shared/interfaces/book.interface';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css'],
})
export class DashboardComponent {
  allBook: IBook[];

  constructor(private bookService: BookService) {
    this.allBook = [];
  }

  ngOnInit(): void {
    this.getBooks();
  }

  public getBooks() {
    this.bookService.getAllBooks().subscribe({
      next: (response) => {
        if (response.success && response.data) {
          this.allBook = response.data;
        }
      },
      error: (error: HttpErrorResponse) => {
        console.log(error);
      },
    });
  }
}
