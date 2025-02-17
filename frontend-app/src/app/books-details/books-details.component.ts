import { Component, Input } from '@angular/core';
import { Book } from '../assets/book';
import { ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';
import { BookService } from '../service/book.service';

@Component({
  selector: 'app-books-details',
  templateUrl: './books-details.component.html',
  styleUrls: ['./books-details.component.css'],
})
export class BooksDetailsComponent {
  books: Array<{ id: number; title: string }> = [];

  constructor(
    private route: ActivatedRoute,
    private bookService: BookService,
    private location: Location
  ) {}

  ngOnInit(): void {
    this.getBook();
  }

  public getBook(): void {
    try {
      const id = Number(this.route.snapshot.paramMap.get('id'));
      this.bookService
        .getBook(id)
        .subscribe((response) => (this.books = response.data));
    } catch (e) {
      console.log('error is', e);
    }
  }

  public save(book: object): void {
    const id = Number(this.route.snapshot.paramMap.get('id'));
    try {
      this.bookService.updateBook(id, book).subscribe(() => this.goBack());
    } catch (e) {
      console.log('error is', e);
    }
  }

  public delete(): void {
    const id = Number(this.route.snapshot.paramMap.get('id'));
    try {
      this.bookService.deleteBooks(id).subscribe(() => this.goBack());
    } catch (e) {
      console.log('error is', e);
    }
  }
  public goBack(): void {
    this.location.back();
  }
}
