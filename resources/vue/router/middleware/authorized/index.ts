import { IMiddleware } from "../middlewarePipeline";
import { UserModule } from "../../../store/modules/user-module";

export const Authorized = ({ next }: IMiddleware) => {
  if (!UserModule.authenticated) {
    return next;
  }

  return next();
};
