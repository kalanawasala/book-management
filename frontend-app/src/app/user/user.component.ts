import { Component, OnInit } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  FormControl,
  Validators,
  NgForm,
} from '@angular/forms';
import { NgControl } from '@angular/forms';
import { UserService } from '../service/user.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css'],
})
export class UserComponent implements OnInit {
  loggedIn: boolean | undefined;

  form = {
    email: [''],
    password: [''],
  };

  public constructor(
    private userService: UserService,
    private fb: FormBuilder,
    private router: Router
  ) {}
  ngOnInit(): void {}
  public login() {
    const val = this.form;

    if (val.email && val.password) {
      this.userService.login(val).subscribe(() => {
        console.log('user is LoggedIn');
        this.router.navigateByUrl('/');
      });
    }
  }
}
