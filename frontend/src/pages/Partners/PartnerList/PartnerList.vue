<template>
  <div>
    <VDataTable
      hide-default-footer
      show-select
      class="elevation-24"
      height="80vh"
      v-model="selectedPartners"
      :fixed-header="true"
      :headers="headers"
      :items="partners"
      :loading="loading"
      :items-per-page="meta.per_page"
      :sortBy.sync="sort.field"
      :sort-desc.sync="sort.descending"
      :server-items-length="pagesCount"
      @update:options="onOptionsChange"
    >
      <template v-slot:top>
        <VToolbar flat color="white">
          <VToolbarTitle>My CRUD</VToolbarTitle>
          <VDivider class="mx-4" inset vertical />
          <VBtn small tile icon color="green"><VIcon>mdi-file-excel</VIcon></VBtn>
          <VSpacer />

          <VBtn small tile color="primary" icon>
            <VIcon>mdi-plus</VIcon>
          </VBtn>
          <VBtn small tile color="teal" icon>
            <VIcon>mdi-filter-outline</VIcon>
          </VBtn>
          <VBtn v-if="selectedPartners.length" small tile color="error" icon>
            <VIcon>mdi-delete</VIcon>
          </VBtn>
        </VToolbar>
      </template>
    </VDataTable>

    <VContainer>
      <VLayout row justify-start>
        <VFlex xs12 md6 lg6 pt-4>
          <VMenu open-on-hover top offset-y>
            <template v-slot:activator="{ on }">
              <VBtn color="primary" v-on="on" class="text-left" :disabled="loading">
                {{ $t("perPage") }}: {{ meta.per_page }}
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
            :value="meta.current_page"
            :length="pagesCount"
            :disabled="loading"
            @input="changePage"
          />
        </VFlex>
      </VLayout>
    </VContainer>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Watch } from "vue-property-decorator";
import { PartnersHttpService } from "@/api/services/partners-http.service";

/** Utils */
import { getPerPageFor, setPerPageFor } from "@/utils/pagination.utils";

/** Interfaces */
import { IPartner } from "@/Interfaces/IPartner";
import { ITableHeader } from "@/Interfaces/ITableHeader";
import { IMeta } from "@/api/interfaces";
import { ISort } from "@/Interfaces/ISort";
import { ITableOptions } from "@/Interfaces/ITableOptions";

const perPageIdentifier = "partnerList";

@Component
export default class PartnerList extends Vue {
  public loading: boolean = false;
  public partners: IPartner[] = [];
  public selectedPartners: IPartner[] = [];
  public perPageVariants = [25, 50, 100, 200];

  public sort: ISort = {
    field: "id",
    descending: false
  };

  public meta: IMeta = {
    current_page: 1,
    from: 1,
    to: 1,
    total: 1,
    path: "",
    last_page: 1,
    per_page: getPerPageFor(perPageIdentifier)
  };

  public headers: ITableHeader[] = [
    { text: "#", value: "id" },
    { text: "name", value: "name" },
    { text: "description", value: "description" },
    { text: "created_at", value: "created_at" }
  ];

  public get pagesCount() {
    return Math.ceil(this.meta.total / this.meta.per_page);
  }

  /**
   * Handle page changing
   */
  public changePage(page: number) {
    this.meta.current_page = page;
    this.getPartnerList();
  }

  /**
   * Handle per page value changing
   * @param perPage
   */
  public changePerPage(perPage: number) {
    this.meta.per_page = perPage;
    setPerPageFor(perPageIdentifier, perPage);
    this.getPartnerList();
  }

  /**
   * Calls after mounting
   * @param options
   */
  public onOptionsChange(options: ITableOptions) {
    this.sort.field = options.sortBy[0];
    this.sort.descending = options.sortDesc[0];
    this.getPartnerList();
  }

  /**
   * Request builder
   */
  public async getPartnerList() {
    try {
      this.loading = true;
      const requestData = {
        perPage: this.meta.per_page,
        page: this.meta.current_page,
        sortBy: this.sort.field,
        order: this.sort.descending ? "desc" : "asc"
      };

      const partnersRes = await PartnersHttpService.getList(requestData);

      this.meta = partnersRes.meta;
      this.partners = partnersRes.result;
    } catch (e) {
      // todo: error handling. Notifications?
    } finally {
      this.loading = false;
    }
  }
}
</script>

<style scoped></style>
