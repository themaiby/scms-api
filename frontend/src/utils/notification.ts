import { ApplicationModule } from "@/store/modules/application-module";

export const notification = (text: string, timeout: number = 2000) => {
  ApplicationModule.setSnackbarText(text);
  ApplicationModule.setSnackbarTimeout(timeout);

  ApplicationModule.setSnackbarColor('blue');
  ApplicationModule.setSnackbar(true);
};
