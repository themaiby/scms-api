<template>
  <div class="SC-table">
    <VDataTable
      hide-default-footer
      show-select
      fixed-header
      class="elevation-24"
      height="80vh"
      v-model="selected"
      :headers="headers"
      :items="items"
      :loading="loading"
      :items-per-page="perPage"
      :sortBy.sync="sortBy_local"
      :sort-desc.sync="descending_local"
      :server-items-length="1"
      @update:options="$emit('update:options', $event)"
    >
      <template v-slot:top>
        <slot />
      </template>
    </VDataTable>
  </div>
</template>

<script lang="ts">
import { Component, Emit, Prop, Vue, Watch } from "vue-property-decorator";
import { ITableHeader } from "@/Interfaces/ITableHeader";

@Component
export default class SCTable extends Vue {
  @Prop({ required: true }) readonly headers!: ITableHeader[];
  @Prop({ required: true }) readonly items!: [];
  @Prop({ default: false }) readonly loading!: boolean;
  @Prop({ default: 1 }) readonly pagesCount!: number;
  @Prop({ default: 1 }) readonly perPage!: number;
  @Prop({ default: "id" }) readonly sortBy!: string;
  @Prop({ default: false }) readonly descending!: boolean;

  public sortBy_local = this.sortBy;
  public descending_local = this.descending;
  public selected: [] = [];

  @Watch("selected")
  @Emit("update:selected")
  emitSelected(selected: []) {
    return selected;
  }
}
</script>

<style scoped></style>
