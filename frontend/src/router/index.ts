import Vue from "vue";
import Router, { Route } from "vue-router";
import ApplicationLayout from "@/pages/Layout/ApplicationLayout/ApplicationLayout.vue";
import Login from "@/pages/Auth/Login/Login.vue";
import {
  middlewarePipeline,
  TMiddleware,
  TNextFunction
} from "@/router/middleware/middlewarePipeline";
import { isAuthorized } from "@/router/middleware/is-authorized";
import { isNotAuthorized } from "@/router/middleware/is-not-authorized";
import { initialization } from "@/router/middleware/initialization";

Vue.use(Router);

export const router = new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/login",
      name: "login",
      component: Login,
      meta: {
        title: "pageName.login",
        middleware: [isNotAuthorized]
      }
    },
    {
      path: "/",
      name: "layout",
      component: ApplicationLayout,
      meta: {
        middleware: [isAuthorized]
      }
    }
  ]
});

/**
 * Middleware pipeline register
 */
router.beforeEach((to: Route, from: Route, next: TNextFunction) => {
  if (!to.meta.middleware) {
    return next();
  }

  /**
   * Initial state middleware
   */
  const middleware: TMiddleware[] = to.meta.middleware
    ? [initialization, ...to.meta.middleware]
    : [initialization];

  const context = { to, from, next };

  return middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1)
  });
});
