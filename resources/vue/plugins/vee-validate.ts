import Vue from "vue";
import VeeValidate from "vee-validate";

// @ts-ignore
import ru from "vee-validate/dist/locale/ru";
// @ts-ignore
import en from "vee-validate/dist/locale/en";

Vue.use(VeeValidate, {
  locale: "ru",
  dictionary: { ru, en }
});
