import { IContact } from "@/interfaces/IContact";
import { ITimestampable } from "@/interfaces/ITimestampable";

export interface IPartner extends ITimestampable {
  id: number;
  name: string;
  description: string;
  user_id: string;
  contacts: IContact[];
  active: boolean;
}
