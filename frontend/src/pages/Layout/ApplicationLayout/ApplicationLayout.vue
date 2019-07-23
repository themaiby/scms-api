<template>
  <div>
    <VToolbar app color="grey lighten-1">
      <VToolbarTitle>SCMS | {{ $route.meta.title }}</VToolbarTitle>
    </VToolbar>
    <VContent>
      <VContainer fluid>
        <router-view></router-view>
      </VContainer>
    </VContent>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component
export default class ApplicationLayout extends Vue {}
</script>

<style scoped></style>
