import { getModule, Module, Mutation, VuexModule } from "vuex-module-decorators";
import { store } from "@/store";
import { ISnackbar } from "@/Interfaces/ISnackbar";

@Module({ dynamic: true, store: store, name: "app" })
class Application extends VuexModule {
  public isLoaded: boolean = false;
  public snackbar: ISnackbar = { active: false, color: "blue", text: "", timeout: 2000 };

  @Mutation
  public setSnackbar(isActive: boolean) {
    this.snackbar.active = isActive;
  }

  @Mutation
  public setSnackbarTimeout(timeout: number) {
    this.snackbar.timeout = timeout;
  }

  @Mutation
  public setLoaded(loaded: boolean) {
    this.isLoaded = loaded;
  }

  @Mutation
  public setSnackbarText(text: string) {
    this.snackbar.text = text;
  }

  @Mutation
  public setSnackbarColor(color: string) {
    this.snackbar.color = color;
  }
}

export const ApplicationModule = getModule(Application);
