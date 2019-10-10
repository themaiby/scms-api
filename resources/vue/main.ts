import "roboto-fontface/css/roboto/roboto-fontface.css";
import "@mdi/font/css/materialdesignicons.css";
import "@babel/polyfill";

import Vue from "vue";
import App from "./App.vue";
// Plugins
import "./plugins/vee-validate";
import "@/plugins/v-clipboard";

import { i18n } from "@/plugins/i18n";
import { router } from "@/router";
import { store } from "@/store";
import { vuetify } from "@/plugins/vuetify";

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  i18n,
  vuetify,
  render: h => h(App)
}).$mount("#app");
