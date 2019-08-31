import { getModule, Module, Mutation, VuexModule } from "vuex-module-decorators";
import { store } from "@/store";
import { IUser } from "@/interfaces/IUser";
import { CurrencyEnum } from "@/interfaces/CurrencyEnum";
import { RefreshStatusEnum } from "@/store/modules/user-module/interfaces";

@Module({ dynamic: true, store: store, name: "user" })
class User extends VuexModule {
  public authenticated = false;
  public refreshStatus: RefreshStatusEnum = RefreshStatusEnum.unknown;
  public user: IUser = {
    active: true,
    currency: CurrencyEnum.USD,
    email: "",
    first_name: "",
    id: 0,
    last_name: "",
    updated_at: "",
    created_at: "",
    permissions: [],
    partners: []
  };

  @Mutation
  setAuthenticated(auth: boolean) {
    this.authenticated = auth;
  }

  @Mutation
  setUser(user: IUser) {
    this.user = user;
  }

  @Mutation
  setRefreshStatus(status: RefreshStatusEnum) {
    this.refreshStatus = status;
  }
}

export const UserModule = getModule(User);
