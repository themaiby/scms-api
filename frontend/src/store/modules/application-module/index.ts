import { getModule, Module, Mutation, VuexModule } from "vuex-module-decorators";
import { store } from "@/store";

@Module({ dynamic: true, store: store, name: "app" })
class Application extends VuexModule {
  public isLoaded: boolean = false;

  @Mutation
  public setLoaded(loaded: boolean) {
    this.isLoaded = loaded;
  }
}

export const ApplicationModule = getModule(Application);
