import { Component, OnInit } from '@angular/core';
import { BookService } from '../book.service';
import { Book } from '../book';

@Component({
  selector: 'app-books',
  templateUrl: './books.component.html',
  styleUrls: ['./books.component.css'],
})
export class BooksComponent {
  //make as object
  allBook = <any>{};

  constructor(private bookService: BookService) {}

  getBooks() {
    try {
      this.bookService.getAllBooks().subscribe((response) => {
        this.allBook = response;
      });
    } catch (e) {
      console.log('error is', e);
    }
  }
  ngOnInit() {
    this.getBooks();
  }
}
