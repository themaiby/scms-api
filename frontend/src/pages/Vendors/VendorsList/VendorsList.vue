<template>
  <VDataTable class="elevation-24" :items="[1, 2, 3]" :loading="true" />
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component
export default class VendorsList extends Vue {
  public headers: [] = [];
}
</script>

<style scoped></style>
