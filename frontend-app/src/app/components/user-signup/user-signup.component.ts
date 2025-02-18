import { Component } from '@angular/core';
import { UserService } from '../../service/user.service';
import { NgForm } from '@angular/forms';
import { IUserJwtResponse } from '../../shared/interfaces/user-jwt-response.interface';
import { HttpErrorResponse, HttpResponse } from '@angular/common/http';
import { IListUserResponse } from '../../shared/interfaces/list-user-response.interface';
import { IHttpResponse } from '../../shared/interfaces/http-response.interface';

@Component({
  selector: './app-user-signup',
  templateUrl: './user-signup.component.html',
  styleUrls: ['./user-signup.component.css'],
})
export class UserSignupComponent {
  constructor(private userService: UserService) {}

  public form = {
    name: '',
    email: '',
    password: '',
    confirmPassword: '',
  };
  public error: any = [];
  public msg: any = null;
  public submitSignup(registrationForm: NgForm) {
    const userValues = this.form;
    if (!(userValues.password === userValues.confirmPassword)) {
      console.log('Password Is Incorrect');
    }
    return this.userService.signup(userValues).subscribe({
      // (data) => console.log(data)
      next: (response) => {
        if (response.success && response.token) {
          this.msg = 'success';
          registrationForm.resetForm();
        }
      },
      error: (error: HttpErrorResponse) => {
        console.log(error);
      },
      // (data) => this.handleResponse(data, registrationForm)
    });
  }
}
