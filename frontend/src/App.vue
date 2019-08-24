<template>
  <v-app class="accent lighten-1">
    <SCSnackbar />

    <VContainer fill-height justify-center v-if="!applicationLoaded" wrap>
      <VProgressCircular indeterminate />
    </VContainer>

    <router-view />
  </v-app>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { ApplicationModule } from "@/store/modules/application-module";

@Component({
  components: {
    SCSnackbar: () => import("@/components/SCSnackbar/SCSnackbar.vue")
  }
})
export default class App extends Vue {
  get applicationLoaded() {
    return ApplicationModule.isLoaded;
  }
}
</script>
