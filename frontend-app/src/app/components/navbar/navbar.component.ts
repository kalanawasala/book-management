import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { AuthService } from 'src/app/service/auth.service';
import { JwtInterceptorService } from 'src/app/service/jwt-interceptor.service';
import { HttpClient } from '@angular/common/http';
import { HttpErrorResponse } from '@angular/common/http';
import { UserService } from 'src/app/service/user.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent implements OnInit {
  isLoggedIn$!: Observable<boolean>;

  constructor(
    private authService: AuthService,
    private userService: UserService,
    private jwtInterceptor: JwtInterceptorService
  ) {}

  ngOnInit(): void {
    this.isLoggedIn$ = this.authService.isUserLoggedIn;
  }
  onLogout(event: MouseEvent) {
    event.preventDefault();
    this.userService.logout().subscribe({
      next: (response) => {
        if (response.success) {
          this.authService.changeAuthStatus(false);
          console.log(response);
        }
      },
      error: (error: HttpErrorResponse) => {
        console.log(error);
      },
    });
  }
}
