import Vue from "vue";
import Router from "vue-router";
import ApplicationLayout from "../pages/Layout/ApplicationLayout/ApplicationLayout.vue";
import Login from "../pages/Auth/Login/Login.vue";
import { Authorized } from "./middleware/authorized";
import { Guest } from "./middleware/guest";
import HomePage from "../pages/HomePage/HomePage.vue";
import { MiddlewarePipeline } from "./middleware/middlewarePipeline";
import VendorsList from "../pages/Vendors/VendorsList/VendorsList.vue";
import PartnerList from "../pages/Partners/PartnerList/PartnerList.vue";

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
        title: "login",
        middleware: [Guest]
      }
    },
    {
      path: "/",
      component: ApplicationLayout,
      name: "layout",
      meta: {
        middleware: [Authorized]
      },
      children: [
        {
          path: "/dashboard",
          name: "main",
          component: HomePage,
          meta: { title: "main" }
        },
        {
          path: "/vendors",
          name: "vendors.list",
          component: VendorsList,
          meta: { title: "vendors" }
        },
        {
          path: "/partners",
          name: "partners.list",
          component: PartnerList,
          meta: { title: "partners" }
        },
        { path: "/components", name: "components.list", component: HomePage },
        { path: "/orders", name: "orders.list", component: HomePage },
        { path: "/settings", name: "settings", component: HomePage },
        { path: "/profile", name: "profile", component: HomePage }
      ]
    },
    { path: "**", name: "not-found", redirect: { name: "main" } }
  ]
});

new MiddlewarePipeline().register();
