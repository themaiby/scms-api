import { getModule, Module, Mutation, VuexModule } from "vuex-module-decorators";
import { store } from "@/store";
import { IUser } from "@/Interfaces/IUser";
import { CurrencyEnum } from "@/Interfaces/CurrencyEnum";

@Module({ dynamic: true, store: store, name: "user" })
class User extends VuexModule {
  public authenticated = false;
  public user: IUser = {
    active: true,
    created_at: "",
    currency: CurrencyEnum.USD,
    email: "",
    first_name: "",
    id: 0,
    last_name: "",
    permissions: [],
    updated_at: ""
  };

  @Mutation
  setAuthenticated(auth: boolean) {
    this.authenticated = auth;
  }

  @Mutation
  setUser(user: IUser) {
    this.user = user;
  }
}

export const UserModule = getModule(User);
