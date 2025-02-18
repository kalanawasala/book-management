import { Component } from '@angular/core';
import { Route, Router } from '@angular/router';
import { AuthService } from 'src/app/service/auth.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent {
  public loggedIn: boolean = false;

  constructor(private authService: AuthService, private router: Router) {}

  ngOnInit(): void {
    this.authService.authStatus.subscribe((value) => {
      this.loggedIn = value;
    });
  }
  logout(event: MouseEvent) {
    event.preventDefault();
    //this.Token.remove();
    //console.log("Logout");
    this.authService.changeAuthStatus(false);
    this.router.navigateByUrl('/login');
  }
}
