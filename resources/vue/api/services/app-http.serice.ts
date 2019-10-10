import { api } from "../index";

export class AppHttpSerice {
  public static async getAppConfig() {
    return await api.get("/app-config.json");
  }
}
