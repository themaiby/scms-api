import { api } from "../index";
import { IAuthData } from "../../interfaces/IAuthData";
import { IUser } from "../../interfaces/IUser";
import { IRequestPagination, IResponse, IResponseCollection } from "../interfaces";
import { IPartner } from "../../interfaces/IPartner";
import { IPartnerCreateRequest } from "../request/IPartnerCreateRequest";
import { IContactCreateRequest } from "../request/IContactCreateRequest";
import { IContact } from "../../interfaces/IContact";

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
