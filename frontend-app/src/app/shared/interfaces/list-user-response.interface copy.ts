import { IUser } from './user.interface';
import { IHttpResponse } from './http-response.interface';

export interface IListUserResponse extends IHttpResponse {
  data: IUser[];
}
