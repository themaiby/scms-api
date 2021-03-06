import { ITimestampable } from "./ITimestampable";

export interface IContact extends ITimestampable {
  id: number;
  partner_id: number;
  title: string;
  value: string;
}
