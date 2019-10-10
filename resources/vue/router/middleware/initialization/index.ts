import { IMiddleware } from "../middlewarePipeline";
import { ApplicationModule } from "../../../store/modules/application-module";
import { getToken } from "../../../utils/auth.utils";
import { AuthHttpService } from "../../../api/services/auth-http.service";
import { UserModule } from "../../../store/modules/user-module";

export const initialization = async ({ next }: IMiddleware) => {
  if (!ApplicationModule.isLoaded) {
    await checkAuthorization();
  }

  ApplicationModule.setLoaded(true);
  return next();
};

const checkAuthorization = async () => {
  if (!getToken()) {
    return;
  }

  try {
    const userData = await AuthHttpService.getMe();
    UserModule.setAuthenticated(true);
    UserModule.setUser(userData);
  } catch (e) {}
};
