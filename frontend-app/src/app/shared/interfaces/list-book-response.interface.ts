import { IBook } from './book.interface';
import { IHttpResponse } from './http-response.interface';

export interface IListBooksResponse extends IHttpResponse {
  data: IBook[];
}
