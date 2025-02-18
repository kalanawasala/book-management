import { IHttpResponse } from './http-response.interface';

export interface IUserJwtResponse extends IHttpResponse {
  token: string;
  token_type: string;
  expires_in: number;
}
