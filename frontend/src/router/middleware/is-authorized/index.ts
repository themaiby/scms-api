import { IMiddleware } from "@/router/middleware/middlewarePipeline";
import { UserModule } from "@/store/modules/user-module";

export const isAuthorized = ({ next }: IMiddleware) => {
  if (!UserModule.authenticated) {
    return next({ name: "login" });
  }

  return next();
};
