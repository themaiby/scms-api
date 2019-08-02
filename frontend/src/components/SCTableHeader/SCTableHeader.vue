<template>
  <VToolbar flat color="white">
    <VToolbarTitle>{{ title }}</VToolbarTitle>
    <VDivider class="mx-4" inset vertical />
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <VBtn small tile icon color="green" v-on="on">
          <VIcon>mdi-file-excel</VIcon>
        </VBtn>
      </template>
      <VList>
        <VListItem @click="">
          <v-list-item-title>{{ $t('exportAll') }}</v-list-item-title>
        </VListItem>
        <VListItem @click="">
          <v-list-item-title>{{ $t('exportFilter') }}</v-list-item-title>
        </VListItem>
      </VList>
    </v-menu>
    <VSpacer />

    <VBtn small tile color="primary" icon @click="$emit('click:add')">
      <VIcon>mdi-plus</VIcon>
    </VBtn>
    <VBtn small tile color="teal" icon @click="$emit('click:filter')">
      <VIcon>mdi-filter-outline</VIcon>
    </VBtn>
    <VBtn v-if="showDeleteButton" small tile color="error" icon @click="$emit('click:delete')">
      <VIcon>mdi-delete</VIcon>
    </VBtn>
  </VToolbar>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component({ name: "SCTableHeader" })
export default class SCTableHeader extends Vue {
  @Prop({ default: "" }) title!: string;
  @Prop({ default: false }) showDeleteButton!: boolean;
}
</script>

<style scoped></style>
