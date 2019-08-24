<template>
  <div>
    <span>Homepage</span>
    <VBtn @click="notify">Show notification</VBtn>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { notification } from "@/utils/notification";

@Component
export default class HomePage extends Vue {
  public notify() {
    notification("Test notification");
  }
}
</script>

<style scoped></style>
