import { ITimestampable } from "@/Interfaces/ITimestampable";

export interface IContact extends ITimestampable {
  id: number;
  partner_id: number;
  title: string;
  value: string;
}
