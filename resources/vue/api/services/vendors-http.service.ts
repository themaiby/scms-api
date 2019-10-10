import { api } from "../index";
import { IRequestPagination, IResponse, IResponseCollection } from "../interfaces";
import { IPartnerCreateRequest } from "../request/IPartnerCreateRequest";
import { IContactCreateRequest } from "../request/IContactCreateRequest";
import { IContact } from "../../interfaces/IContact";
import { IVendor } from "../../interfaces/IVendor";

export class VendorsHttpService {
  public static async getList(query?: IRequestPagination): Promise<IResponseCollection<IVendor>> {
    return (await api.get("/vendors", { params: query })).data;
  }

  public static async get(id: number): Promise<IResponse<IVendor>> {
    return (await api.get(`/vendors/${id}`)).data;
  }

  public static async create(data: IPartnerCreateRequest): Promise<IResponse<IVendor>> {
    return (await api.post("/vendors", data)).data;
  }

  public static async createContact(
    partnerId: number,
    contact: IContactCreateRequest
  ): Promise<IResponseCollection<IContact>> {
    return (await api.post(`/vendors/${partnerId}/contacts`, contact)).data;
  }
}
