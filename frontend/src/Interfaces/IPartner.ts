import { IContact } from "@/Interfaces/IContact";
import { ITimestampable } from "@/Interfaces/ITimestampable";

export interface IPartner extends ITimestampable {
  id: number;
  name: string;
  description: string;
  user_id: string;
  contacts: IContact[];
  active: boolean;
}
