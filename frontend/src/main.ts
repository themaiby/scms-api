import "roboto-fontface/css/roboto/roboto-fontface.css";
import "@mdi/font/css/materialdesignicons.css";
import "@babel/polyfill";

import Vue from "vue";
import App from "./App.vue";

// Plugins
import "@/plugins/vuetify";
import "@/plugins/vee-validate";
import { i18n } from "@/plugins/i18n";
import { router } from "@/router";
import { store } from "@/store";

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  i18n,
  render: h => h(App)
}).$mount("#app");
