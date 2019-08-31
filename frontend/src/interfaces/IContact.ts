import { ITimestampable } from "@/interfaces/ITimestampable";

export interface IContact extends ITimestampable {
  id: number;
  partner_id: number;
  title: string;
  value: string;
}
