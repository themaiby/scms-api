<template>
  <VSnackbar top right v-model="model" :color="color" :timeout="timeout" class="mt-12">
    {{ text }}
    <v-btn text @click="model = false">
      {{ $t("close") }}
    </v-btn>
  </VSnackbar>
</template>

<script lang="ts">
import { Component, Vue, Watch } from "vue-property-decorator";
import { ApplicationModule } from "../../store/modules/application-module";

@Component
export default class SCSnackbar extends Vue {
  @Watch("model") destroySnackbar(model: boolean) {
    if (!model) {
      this.text = "";
      this.timeout = 2000;
      this.color = "blue";
    }
  }

  public get model() {
    return ApplicationModule.snackbar.active;
  }

  public set model(isActive: boolean) {
    ApplicationModule.setSnackbar(isActive);
  }

  public get timeout() {
    return ApplicationModule.snackbar.timeout;
  }

  public set timeout(timeout: number) {
    ApplicationModule.setSnackbarTimeout(timeout);
  }

  public get text() {
    return ApplicationModule.snackbar.text;
  }

  public set text(text: string) {
    ApplicationModule.setSnackbarText(text);
  }

  public get color() {
    return ApplicationModule.snackbar.color;
  }

  public set color(color: string) {
    ApplicationModule.setSnackbarColor(color);
  }
}
</script>
