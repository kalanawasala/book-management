import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { BooksComponent } from '../components/books/books.component';
import { BrowserModule } from '@angular/platform-browser';
import { DashboardComponent } from '../components/dashboard/dashboard.component';
import { BooksDetailsComponent } from '../components/books-details/books-details.component';
import { UserComponent } from '../components/user/user.component';
import { UserSignupComponent } from '../components/user-signup/user-signup.component';

const routes: Routes = [
  { path: 'details/:id', component: BooksDetailsComponent },
  { path: 'books', component: BooksComponent },
  { path: 'dashboard', component: DashboardComponent },
  { path: 'login', component: UserComponent },
  { path: 'register', component: UserSignupComponent },
  { path: '', redirectTo: '/dashboard', pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes), BrowserModule, HttpClientModule],
  exports: [RouterModule],
})
export class AppRoutingModule {}
