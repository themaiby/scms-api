import { api } from "@/api";
import { IAuthData } from "@/Interfaces/IAuthData";
import { IUser } from "@/Interfaces/IUser";
import { IRequestPagination, IResponse, IResponseCollection } from "@/api/interfaces";
import { IPartner } from "@/Interfaces/IPartner";
import { IPartnerCreateRequest } from "@/api/request/IPartnerCreateRequest";
import { IContactCreateRequest } from "@/api/request/IContactCreateRequest";
import { IContact } from "@/Interfaces/IContact";

export class PartnersHttpService {
  public static async getList(query?: IRequestPagination): Promise<IResponseCollection<IPartner>> {
    return (await api.get("/partners", { params: query })).data;
  }

  public static async get(id: number): Promise<IResponse<IPartner>> {
    return (await api.get(`partners/${id}`)).data;
  }

  public static async create(data: IPartnerCreateRequest): Promise<IResponse<IPartner>> {
    return (await api.post("/partners", data)).data;
  }

  public static async createContact(
    partnerId: number,
    contact: IContactCreateRequest
  ): Promise<IResponseCollection<IContact>> {
    return (await api.post(`/partners/${partnerId}/contacts`, contact)).data;
  }
}
