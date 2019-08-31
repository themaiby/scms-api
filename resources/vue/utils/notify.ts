import { ApplicationModule } from "../store/modules/application-module";

export class Notify {
  public static info(text: string, timeout: number = 2000) {
    ApplicationModule.setSnackbarText(text);
    ApplicationModule.setSnackbarTimeout(timeout);

    ApplicationModule.setSnackbarColor("blue");
    ApplicationModule.setSnackbar(true);
  }

  public static success(text: string, timeout: number = 2000) {
    ApplicationModule.setSnackbarText(text);
    ApplicationModule.setSnackbarTimeout(timeout);

    ApplicationModule.setSnackbarColor("green");
    ApplicationModule.setSnackbar(true);
  }
}
