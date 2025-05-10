import { Component, OnInit } from '@angular/core';
import { BookService } from '../../service/book.service';
import { HttpErrorResponse } from '@angular/common/http';
import { IBook } from '../../shared/interfaces/book.interface';
import { NgForm } from '@angular/forms';

@Component({
  selector: './app-books',
  templateUrl: './books.component.html',
  styleUrls: ['./books.component.css'],
})
export class BooksComponent implements OnInit {
  allBook: IBook[];
  msg!: boolean;

  public form = {
    title: '',
  };

  constructor(private bookService: BookService) {
    this.allBook = [];
  }

  ngOnInit() {
    this.getBooks();
  }

  public getBooks() {
    this.bookService.getAllBooks().subscribe({
      next: (response) => {
        if (response.success && response.data) {
          // console.log(response.data);
          this.allBook = response.data;
        }
      },
      error: (error: HttpErrorResponse) => {
        console.log(error);
      },
    });
  }

  public addBooks(createForm: NgForm): void {
    const title = this.form;
    if (!title) {
      this.msg = false;
    }
    this.bookService.addBooks(title).subscribe({
      next: (response) => {
        if (response.success) {
          this.getBooks();
        }
      },
      error: (error: HttpErrorResponse) => {
        this.msg = true;
        console.log(error);
      },
    });
  }
}
