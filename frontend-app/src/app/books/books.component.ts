import { Component, OnInit } from '@angular/core';
import { BookService } from '../service/book.service';
import { Book } from '../assets/book';
import { tick } from '@angular/core/testing';

@Component({
  selector: 'app-books',
  templateUrl: './books.component.html',
  styleUrls: ['./books.component.css'],
})
export class BooksComponent implements OnInit {
  //make as object
  allBook: Array<{ id: number; title: string }> = [];

  constructor(private bookService: BookService) {}

  ngOnInit() {
    this.getBooks();
  }

  public getBooks() {
    try {
      this.bookService.getAllBooks().subscribe((response) => {
        this.allBook = response.data;
      });
    } catch (e) {
      console.log('error is', e);
    }
  }

  public addBooks(title: string): void {
    // this.bookService.addBooks(this.allBook).subscribe((response) => {
    //   console.log('User created:', response);
    //   this.getBooks();
    //   this.allBook.add = response;
    title = title.trim();
    if (!title) {
      return;
    }
    this.bookService.addBooks({ title } as any).subscribe((response) => {
      this.allBook = response.data;
      this.getBooks();
    });
  }
}
