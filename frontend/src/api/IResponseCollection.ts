export interface IResponseCollection<T> {
  result: T[];
  meta: {
    per_page: number;
    current_page: number;
    from: number;
    to: number;
    last_page: number;
    path: string;
  };
}
