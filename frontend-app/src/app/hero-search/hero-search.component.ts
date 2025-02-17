import { Component, OnInit } from '@angular/core';
import { Observable, Subject } from 'rxjs';
import { debounceTime, distinctUntilChanged, switchMap } from 'rxjs/operators';
import { BookService } from '../served/book.service';
import { CommonModule } from '@angular/common';
import { Book } from '../assets/book';

@Component({
  selector: 'app-hero-search',
  templateUrl: './hero-search.component.html',
  styleUrls: ['./hero-search.component.css'],
})
export class HeroSearchComponent implements OnInit {
  // books$!: Observable<{
  //   success: boolean;
  //   message: string;
  //   data: Array<{ id: number; title: string }>;
  // }>;

  books$!: Observable<any>;

  private searchTerms = new Subject<string>();

  constructor(private bookService: BookService) {}

  // Push a search term into the observable stream.
  search(term: string): void {
    this.searchTerms.next(term);
  }

  ngOnInit(): void {
    this.books$ = this.searchTerms.pipe(
      // wait 300ms after each keystroke before considering the term
      debounceTime(300),

      // ignore new term if same as previous term
      distinctUntilChanged(),

      // switch to new search observable each time the term changes
      switchMap((term: string) => this.bookService.searchedBook(term))
    );
  }
}
