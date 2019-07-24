import { initialization } from "@/router/middleware/initialization";
import { router } from "@/router";
import { Route } from "vue-router";
import { VueRouter } from "vue-router/types/router";

export type TNextFunction = (to?: string | false | { name: string }) => void;
export interface IMiddleware {
  next: TNextFunction;
}

export class MiddlewarePipeline {
  private GlobalMiddleware: Function[] = [initialization];

  // Initialize Middleware list
  public register() {
    router.beforeEach(async (to: Route, from: Route, next: any) => {
      let middlewareList: Function[];

      middlewareList = to.meta.middleware
        ? [...this.GlobalMiddleware, ...to.meta.middleware]
        : [...this.GlobalMiddleware];

      const context = { to, from, next, router };
      const nextMiddleware = this.nextFactory(context, middlewareList, 1);
      return await middlewareList[0]({ ...context, next: nextMiddleware });
    });
  }

  /**
   * @param context
   * @param middlewareList
   * @param index
   */
  private nextFactory(
    context: { next: any; router: VueRouter; from: Route; to: Route },
    middlewareList: Function[],
    index: number
  ) {
    const subSequentMiddleware = middlewareList[index];
    if (!subSequentMiddleware) return context.next;

    return async (...parameters: any) => {
      context.next(...parameters);
      const nextMiddleware = this.nextFactory(context, middlewareList, index + 1);
      await subSequentMiddleware({ ...context, next: nextMiddleware });
    };
  }
}
