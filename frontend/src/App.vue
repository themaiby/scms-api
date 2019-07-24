<template>
  <v-app>
    <VContainer fill-height justify-center v-if="!applicationLoaded" wrap>
      <VProgressCircular indeterminate />
    </VContainer>

    <router-view v-else />
  </v-app>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { ApplicationModule } from "@/store/modules/application-module";

@Component
export default class App extends Vue {
  get applicationLoaded() {
    return ApplicationModule.isLoaded;
  }
}
</script>
