import { Component, OnInit } from '@angular/core';
import { UserService } from '../../service/user.service';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/service/auth.service';
import { IUserJwtResponse } from 'src/app/shared/interfaces/user-jwt-response.interface';
import { HttpErrorResponse } from '@angular/common/http';
import { FormGroup, Validators, FormsModule } from '@angular/forms';

@Component({
  selector: './app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css'],
})
export class UserComponent implements OnInit {
  private formSubmitAttempt: boolean | undefined;
  public error: any = [];
  public msg: any;

  public form = {
    email: '',
    password: '',
  };

  public constructor(
    private userService: UserService,
    private router: Router,
    private authService: AuthService
  ) {}
  ngOnInit(): void {}
  public onSubmit() {
    const val = this.form;

    if (val.email && val.password) {
      this.userService.login(val).subscribe({
        next: (response) => {
          if (response) {
            console.log('user is LoggedIn');
            // console.log(response);
            this.handleResponse(response);
          } else {
            this.msg = true;
          }
        },
        error: (error: HttpErrorResponse) => {
          this.msg = error.error;
        },
      });
    }
    this.formSubmitAttempt = true;
  }
  handleResponse(response: boolean) {
    // this.token.handle(data.access_token);
    this.authService.changeAuthStatus(true);
    this.router.navigateByUrl('dashboard');
  }
}
