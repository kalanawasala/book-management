import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { BooksComponent } from '../components/books/books.component';
import { BrowserModule } from '@angular/platform-browser';
import { DashboardComponent } from '../components/dashboard/dashboard.component';
import { BooksDetailsComponent } from '../components/books-details/books-details.component';
import { UserComponent } from '../components/user/user.component';
import { authGuard } from '../guards/auth.guard';
import { UserLayoutComponent } from '../layouts/user-layout/user-layout.component';
import { LoginLayoutComponent } from '../layouts/login-layout/login-layout.component';
import { UserSignupComponent } from '../components/user-signup/user-signup.component';

const routes: Routes = [
  {
    path: 'details/:id',
    component: BooksDetailsComponent,
    canActivate: [authGuard],
  },
  {
    path: 'books',
    component: BooksComponent,
    pathMatch: 'full',
    canActivate: [authGuard],
  },
  {
    path: 'dashboard',
    component: DashboardComponent,
    pathMatch: 'full',
    canActivate: [authGuard],
  },
  {
    path: 'login',
    component: UserComponent,
    pathMatch: 'full',
  },
  {
    path: 'user',
    component: UserSignupComponent,
    pathMatch: 'full',
    canActivate: [authGuard],
  },
  {
    path: '',
    redirectTo: '/login',
    pathMatch: 'full',
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes), BrowserModule, HttpClientModule],
  exports: [RouterModule],
})
export class AppRoutingModule {}
