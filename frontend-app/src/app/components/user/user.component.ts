import { Component, OnInit } from '@angular/core';
import { UserService } from '../../service/user.service';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/service/auth.service';
import { IUserJwtResponse } from 'src/app/shared/interfaces/user-jwt-response.interface';
import { HttpErrorResponse } from '@angular/common/http';
import { FormGroup, Validators, FormsModule } from '@angular/forms';
import { Token } from '@angular/compiler';
import { TokenService } from 'src/app/service/token.service';
import { Observable } from 'rxjs';

@Component({
  selector: './app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css'],
})
export class UserComponent implements OnInit {
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
          if (response.success) {
            this.handleResponse(response.token);
          } else {
            this.msg = true;
          }
        },
        error: (error: HttpErrorResponse) => {
          this.msg = error.error;
        },
      });
    }
  }
  handleResponse(data: string) {
    localStorage.setItem('JWT_Token', data);
    this.authService.changeAuthStatus(true);
    this.router.navigateByUrl('dashboard');
  }
}
