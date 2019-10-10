import { CurrencyEnum } from "./CurrencyEnum";
import { IPermission } from "./IPermission";
import { IPartner } from "./IPartner";
import { ITimestampable } from "./ITimestampable";

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
