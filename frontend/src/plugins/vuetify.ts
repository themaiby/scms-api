import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import ru from "vuetify/src/locale/ru";

Vue.use(Vuetify, {
  theme: {
    primary: "#002F37",
    secondary: "#161318",
    accent: "#EADCD9",
    error: "#FF5252",
    info: "#4D9EB7",
    success: "#4A7097",
    warning: "#FFC107"
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
