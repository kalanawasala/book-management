import { IUserJwtResponse } from './user-jwt-response.interface';

export interface IJwtTokenResponse extends IUserJwtResponse {
  Authorization: string;
}
