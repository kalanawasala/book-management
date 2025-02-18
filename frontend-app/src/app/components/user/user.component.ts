import { Component, OnInit } from '@angular/core';
import { UserService } from '../../service/user.service';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/service/auth.service';
import { IUserJwtResponse } from 'src/app/shared/interfaces/user-jwt-response.interface';
import { HttpErrorResponse } from '@angular/common/http';

@Component({
  selector: './app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css'],
})
export class UserComponent implements OnInit {
  loggedIn: boolean | undefined;

  public form = {
    email: '',
    password: '',
  };

  public constructor(
    private userService: UserService,
    private router: Router,
    private authService: AuthService
  ) {
    console.log('==' + this.loggedIn);
  }
  ngOnInit(): void {}
  public login() {
    const val = this.form;

    if (val.email && val.password) {
      this.userService.login(val).subscribe({
        next: (response) => {
          if (response.success) {
            // console.log('user is LoggedIn');
            console.log(response);
            (response: IUserJwtResponse) => this.handleResponse(response);
            this.router.navigateByUrl('/');
          }
        },
        error: (error: HttpErrorResponse) => {
          console.log(error);
        },
      });
    }
  }
  handleResponse(response: IUserJwtResponse) {
    // console.log(response);
    // this.token.handle(data.access_token);
    this.authService.changeAuthStatus(true);
    this.router.navigateByUrl('/');
  }
}
