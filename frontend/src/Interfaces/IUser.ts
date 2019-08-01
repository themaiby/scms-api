import { CurrencyEnum } from "@/Interfaces/CurrencyEnum";
import { IPermission } from "@/Interfaces/IPermission";
import { IPartner } from "@/Interfaces/IPartner";
import { ITimestampable } from "@/Interfaces/ITimestampable";

export interface IUser extends ITimestampable {
  id: number;
  first_name: string;
  last_name: string;
  email: string;
  active: boolean;
  currency: CurrencyEnum;

  partners: IPartner[];
  permissions: IPermission[];
}
