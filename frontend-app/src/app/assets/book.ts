export interface Book {
  success: boolean;
  message: string;
  data: Array<{ id: number; title: string }>;
}
