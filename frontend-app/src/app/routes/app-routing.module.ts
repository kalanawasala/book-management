import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { BooksComponent } from '../books/books.component';
import { BrowserModule } from '@angular/platform-browser';
import { DashboardComponent } from '../dashboard/dashboard.component';
import { BooksDetailsComponent } from '../books-details/books-details.component';

const routes: Routes = [
  { path: 'details/:id', component: BooksDetailsComponent },
  { path: 'books', component: BooksComponent },
  { path: 'dashboard', component: DashboardComponent },
  { path: '', redirectTo: '/dashboard', pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes), BrowserModule, HttpClientModule],
  exports: [RouterModule],
})
export class AppRoutingModule {}
