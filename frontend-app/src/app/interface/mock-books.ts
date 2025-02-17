import { Book } from './book';
export class book implements Book {
  success: any;
  message: any;
  data: Array<{ id: number; title: string }> = [];
}
