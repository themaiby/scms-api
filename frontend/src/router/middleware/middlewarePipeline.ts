import { Route } from "vue-router";

export type TNextFunction = (to?: string | { name: string } | false) => void;
export type TMiddleware = (any?: any) => TNextFunction;

export interface IMiddleware {
  next: TNextFunction;
}

interface IContext {
  to: Route;
  from: Route;
  next: TNextFunction;
}

export const middlewarePipeline = (context: IContext, middleware: TMiddleware[], index: number) => {
  const nextMiddleware = middleware[index];

  if (!nextMiddleware) {
    return context.next;
  }

  return () => {
    const nextPipeline = middlewarePipeline(context, middleware, index + 1);
    nextMiddleware({ ...context, next: nextPipeline });
  };
};
