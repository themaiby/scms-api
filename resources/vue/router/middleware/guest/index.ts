import { IMiddleware } from "../middlewarePipeline";
import { UserModule } from "../../../store/modules/user-module";

export const Guest = ({ next }: IMiddleware) => {
  if (UserModule.authenticated) {
    return next({ name: "main" });
  }

  return next();
};
