import { api } from "@/api";
import { IAuthData } from "@/interfaces/IAuthData";
import { IUser } from "@/interfaces/IUser";

export class AuthHttpService {
  public static async login(email: string, password: string): Promise<IAuthData> {
    return (await api.post("/auth/login", { email, password })).data;
  }

  public static async refreshToken(): Promise<IAuthData> {
    return (await api.post("/auth/refresh")).data;
  }

  public static async getMe(): Promise<IUser> {
    return (await api.post("/auth/me")).data;
  }
}
