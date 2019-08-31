<template>
  <VToolbar flat color="white">
    <VBtn icon @click="$emit('click:refresh')">
      <VIcon>mdi-refresh</VIcon>
    </VBtn>
    <VDivider class="mx-4" inset vertical />
    <VMenu offset-y open-on-hover>
      <template v-slot:activator="{ on }">
        <VBtn small tile color="primary" v-on="on">
          {{ $t('export') }}
        </VBtn>
      </template>
      <VList>
        <VListItem @click="$emit('click:export:all')">
          <v-list-item-title>{{ $t("exportAll") }}</v-list-item-title>
        </VListItem>
        <VListItem @click="$emit('click:export:filter')">
          <v-list-item-title>{{ $t("exportFilter") }}</v-list-item-title>
        </VListItem>
      </VList>
    </VMenu>
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
  @Prop({ default: false }) showDeleteButton!: boolean;
}
</script>

<style scoped></style>
