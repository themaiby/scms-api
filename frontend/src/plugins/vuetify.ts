import "vuetify/dist/vuetify.min.css";
import Vue from "vue";
import Vuetify from "vuetify";
import ru from "vuetify/src/locale/ru";
import { VApp } from "vuetify/lib";

Vue.use(Vuetify, {});

export const vuetify = new Vuetify({
  theme: {
    themes: {
      light: {
        primary: "#002F37",
        secondary: "#161318",
        accent: "#EADCD9",
        error: "#FF5252",
        info: "#4D9EB7",
        success: "#4A7097",
        warning: "#FFC107"
      }
    }
  },
  options: {
    customProperties: true
  },
  iconfont: "mdi",
  lang: {
    locales: { ru },
    current: "ru"
  }
});
