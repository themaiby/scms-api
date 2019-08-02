<template>
  <div>
    <SCTable
      :headers="headers"
      :items="partners"
      :loading="loading"
      @update:options="onOptionsChange"
      @update:selected="selectedPartners = $event"
    >
      <SCTableHeader :show-delete-button="selectedPartners.length" />
    </SCTable>

    <VContainer>
      <SCTablePagination
        page-id="partner-list"
        :page="meta.current_page"
        :per-page="meta.per_page"
        :pages-count="pagesCount"
        :per-page-variants="perPageVariants"
        :loading="loading"
        @change:page="changePage"
        @change:per-page="changePerPage"
      />
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
import SCTable from "@/components/SCTable/SCTable.vue";
import SCTableHeader from "@/components/SCTableHeader/SCTableHeader.vue";
import SCTablePagination from "@/components/SCTablePagination/SCTablePagination.vue";

const perPageIdentifier = "partnerList";

@Component({
  name: "PartnerList",
  components: {
    SCTablePagination,
    SCTable,
    SCTableHeader
  }
})
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
    this.meta.current_page = 1;
    this.meta.per_page = perPage;
    this.getPartnerList();
  }

  /**
   * Calls after mounting
   * @param options
   */
  public onOptionsChange(options: ITableOptions) {
    console.log(options);
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
