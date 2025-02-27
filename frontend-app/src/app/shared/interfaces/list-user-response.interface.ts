import { IUser } from './user.interface';
import { IHttpResponse } from './http-response.interface';
import { IUserJwtResponse } from './user-jwt-response.interface';

export interface IListUserResponse extends IUserJwtResponse {
  data: IUser[];
}
