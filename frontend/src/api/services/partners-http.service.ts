import { api } from "@/api";
import { IAuthData } from "@/Interfaces/IAuthData";
import { IUser } from "@/Interfaces/IUser";
import { IRequestPagination, IResponseCollection } from "@/api/interfaces";
import { IPartner } from "@/Interfaces/IPartner";

export class PartnersHttpService {
  public static async getList(query?: IRequestPagination): Promise<IResponseCollection<IPartner>> {
    return (await api.get("/partners", { params: query })).data;
  }
}
