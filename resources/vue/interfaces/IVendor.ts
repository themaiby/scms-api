import { IUser } from "./IUser";
import { IContact } from "./IContact";

export interface IVendor {
  id: number;
  user_id: number;
  user: IUser;
  name: string;
  description: string;
  components_count: number;
  components_cost: number;
  active: boolean;
  created_at: string;
  updated_at: string;
  // components: IComponent[]; todo
  contacts: IContact[];
}
