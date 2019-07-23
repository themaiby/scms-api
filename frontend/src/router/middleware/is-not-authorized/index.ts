import { IMiddleware } from "@/router/middleware/middlewarePipeline";
import { UserModule } from "@/store/modules/user-module";

export const isNotAuthorized = ({ next }: IMiddleware) => {
  if (UserModule.authenticated) {
    return next({ name: "layout" });
  }

  return next();
};
