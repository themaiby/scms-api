import { api } from "@/api";
import { IRequestPagination, IResponse, IResponseCollection } from "@/api/interfaces";
import { IPartnerCreateRequest } from "@/api/request/IPartnerCreateRequest";
import { IContactCreateRequest } from "@/api/request/IContactCreateRequest";

import { IPartner } from "@/interfaces/IPartner";
import { IContact } from "@/interfaces/IContact";

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

  public static async delete(id: number): Promise<IResponse<{}>> {
    return (await api.delete(`partners/${id}`)).data;
  }

  public static async createContact(
    partnerId: number,
    contact: IContactCreateRequest
  ): Promise<IResponseCollection<IContact>> {
    return (await api.post(`/partners/${partnerId}/contacts`, contact)).data;
  }
}
