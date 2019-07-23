import { PermissionEnum } from "@/Interfaces/PermissionEnum";

export interface IPermission {
  id: number;
  name: PermissionEnum;
  guard_name: string;
  created_at: string;
  updated_at: string;
}
