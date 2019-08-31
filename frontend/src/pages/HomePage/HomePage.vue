<template>
  <div>
    <span>Homepage</span>
    <VBtn @click="notify">Show notification</VBtn>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Notify } from "@/utils/notify";

@Component
export default class HomePage extends Vue {
  public notify() {
    Notify.info("Jrcf");
  }
}
</script>

<style scoped></style>
