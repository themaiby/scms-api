import { CurrencyEnum } from "@/Interfaces/CurrencyEnum";
import { IPermission } from "@/Interfaces/IPermission";

export interface IUser {
  id: number;
  first_name: string;
  last_name: string;
  email: string;
  active: boolean;
  currency: CurrencyEnum;
  created_at: string;
  updated_at: string;
  permissions: IPermission[];
}
