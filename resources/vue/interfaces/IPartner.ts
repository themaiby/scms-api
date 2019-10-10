import { IContact } from "./IContact";
import { ITimestampable } from "./ITimestampable";
import { IUser } from "@/interfaces/IUser";

export interface IPartner extends ITimestampable {
  id: number;
  name: string;
  description: string;
  user_id: string;
  user?: IUser;
  contacts: IContact[];
  active: boolean;
}
