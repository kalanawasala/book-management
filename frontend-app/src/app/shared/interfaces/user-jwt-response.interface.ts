export interface IUserJwtResponse {
  success: boolean;
  token: string;
  token_type: string;
  expires_in: number;
}
