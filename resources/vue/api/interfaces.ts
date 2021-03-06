export interface IMeta {
  per_page: number;
  current_page: number;
  from: number;
  to: number;
  last_page: number;
  path: string;
  total: number;
}

export interface IResponse<T> {
  result: T;
}

export interface IResponseCollection<T> {
  result: T[];
  meta: IMeta;
}

export interface IRequestPagination {
  /** Page number */
  page?: number;

  /** Items per page */
  perPage?: number;

  /** Sort by field name */
  sort?: string;

  /** Sort direction */
  direction?: string;
}
