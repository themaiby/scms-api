import { CurrencyEnum } from "@/interfaces/CurrencyEnum";
import { IPermission } from "@/interfaces/IPermission";
import { IPartner } from "@/interfaces/IPartner";
import { ITimestampable } from "@/interfaces/ITimestampable";

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
