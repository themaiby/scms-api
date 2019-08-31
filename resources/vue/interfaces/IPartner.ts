import { IContact } from "./IContact";
import { ITimestampable } from "./ITimestampable";

export interface IPartner extends ITimestampable {
  id: number;
  name: string;
  description: string;
  user_id: string;
  contacts: IContact[];
  active: boolean;
}
