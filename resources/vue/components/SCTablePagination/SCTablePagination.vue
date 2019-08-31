<template>
  <VLayout row justify-start>
    <VFlex xs12 md6 lg6 pt-4>
      <VMenu open-on-hover top offset-y>
        <template v-slot:activator="{ on }">
          <VBtn color="primary" v-on="on" class="text-left" :disabled="loading">
            {{ $t("perPage") }}: {{ perPage }}
          </VBtn>
        </template>

        <VList>
          <VListItem
            v-for="(perPage, index) in perPageVariants"
            :key="index"
            @click="changePerPage(perPage)"
          >
            <v-list-item-title>{{ perPage }}</v-list-item-title>
          </VListItem>
        </VList>
      </VMenu>
    </VFlex>

    <VFlex xs12 md6 lg6 pt-2>
      <VPagination
        class="ml-0 mr-0 justify-end"
        :value="page"
        :length="pagesCount"
        :disabled="loading"
        @input="changePage"
      />
    </VFlex>
  </VLayout>
</template>

<script lang="ts">
import { Component, Emit, Prop, Vue } from "vue-property-decorator";
import { getPerPageFor, setPerPageFor } from "../../utils/pagination.utils";

@Component
export default class SCTablePagination extends Vue {
  @Prop({ default: 1 }) page!: number;
  @Prop({ default: 1 }) pagesCount!: number;
  @Prop({ default: () => [] }) perPageVariants!: [];
  @Prop({ default: false }) loading!: boolean;
  @Prop({ default: "" }) pageId!: string;

  public perPage = getPerPageFor(this.pageId);

  @Emit("change:page") changePage(page: number) {
    return page;
  }

  @Emit("change:per-page") changePerPage(count: number) {
    this.perPage = count;
    setPerPageFor(this.pageId, count);
    return count;
  }
}
</script>

<style scoped></style>
