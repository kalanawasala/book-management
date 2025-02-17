import { Component } from '@angular/core';
import { BookService } from '../served/book.service';
import { Book } from '../assets/book';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css'],
})
export class DashboardComponent {
  allBook: Array<{ id: number; title: string }> = [];

  constructor(private bookService: BookService) {}

  ngOnInit(): void {
    this.getBooks();
  }

  public getBooks() {
    try {
      this.bookService.getAllBooks().subscribe((response) => {
        this.allBook = response.data.slice(1, 5);
      });
    } catch (e) {
      console.log('error is', e);
    }
  }
}
