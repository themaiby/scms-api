import { api } from "@/api";
import { IAuthData } from "@/Interfaces/IAuthData";
import { IUser } from "@/Interfaces/IUser";

export class AuthHttpService {
  public static async login(email: string, password: string): Promise<IAuthData> {
    return (await api.post("/auth/login", { email, password })).data;
  }

  public static async refresToken(): Promise<IAuthData> {
    return (await api.post("/auth/refresh")).data;
  }

  public static async getMe(): Promise<IUser> {
    return (await api.post("/auth/me")).data;
  }
}
