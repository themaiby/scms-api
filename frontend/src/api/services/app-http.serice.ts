import { api } from "@/api";

export class AppHttpSerice {
  public static async getAppConfig() {
    return await api.get("/app-config.json");
  }
}
