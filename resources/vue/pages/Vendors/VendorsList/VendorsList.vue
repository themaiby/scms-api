<template>
  <div>
    <SCTable
      expandable
      :headers="headers"
      :items="vendors"
      :loading="loading"
      @update:options="onOptionsChange"
      @update:selected="selectedVendors = $event"
    >
      <template v-slot:header>
        <SCTableHeader
          :show-delete-button="selectedVendors.length"
          @click:add="isVendorCreateOpen = true"
          @click:filter="1"
          @click:delete="1"
          @click:refresh="getVendorList"
        />
      </template>

      Replace with vendorcard?
      <template v-slot:expand="{ item }">
        <PartnerCard :partner="item" />
      </template>
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
import { Component, Vue } from "vue-property-decorator";
import { IVendor } from "../../../interfaces/IVendor";
import { ISort } from "../../../interfaces/ISort";
import { IMeta } from "../../../api/interfaces";
import { getPerPageFor } from "../../../utils/pagination.utils";
import { ITableHeader } from "../../../interfaces/ITableHeader";
import { getTranslatedHeaders } from "../../../utils/table.utils";
import { ITableOptions } from "../../../interfaces/ITableOptions";
import { VendorsHttpService } from "../../../api/services/vendors-http.service";
import SCTablePagination from "../../../components/SCTablePagination/SCTablePagination.vue";
import SCTable from "../../../components/SCTable/SCTable.vue";
import SCTableHeader from "../../../components/SCTableHeader/SCTableHeader.vue";

const perPageIdentifier = "vendorList";

@Component({
  components: { SCTablePagination, SCTable, SCTableHeader }
})
export default class VendorsList extends Vue {
  public loading: boolean = false;
  public vendors: IVendor[] = [];
  public selectedVendors: IVendor[] = []; // todo: batch deleting
  public perPageVariants = [25, 50, 100, 200]; // todo: separate?
  public isVendorCreateOpen = false;

  public sort: ISort = { field: "id", descending: false };

  public meta: IMeta = {
    current_page: 1,
    from: 1,
    to: 1,
    total: 1,
    path: "",
    last_page: 1,
    per_page: getPerPageFor(perPageIdentifier)
  };

  public headers: ITableHeader[] = getTranslatedHeaders([
    { text: "#", value: "id" },
    { text: "name", value: "name" },
    { text: "components_count", value: "components_count" },
    { text: "components_cost", value: "components_cost" },
    { text: "created_at", value: "crEATED_AT" }
  ]);

  public get pagesCount() {
    return Math.ceil(this.meta.total / this.meta.per_page);
  }

  public onVendorCreated() {
    this.isVendorCreateOpen = false;
    this.getVendorList();
  }

  /**
   * Handle page changing
   */
  public changePage(page: number) {
    this.meta.current_page = page;
    this.getVendorList();
  }

  /**
   * Handle per page value changing
   * @param perPage
   */
  public changePerPage(perPage: number) {
    this.meta.current_page = 1;
    this.meta.per_page = perPage;
    this.getVendorList();
  }

  /**
   * Calls after mounting
   * @param options
   */
  public onOptionsChange(options: ITableOptions) {
    this.sort.field = options.sortBy[0];
    this.sort.descending = options.sortDesc[0];
    this.getVendorList();
  }

  /**
   * Request builder
   */
  public async getVendorList() {
    try {
      this.loading = true;
      const requestData = {
        perPage: this.meta.per_page,
        page: this.meta.current_page,
        sortBy: this.sort.field,
        order: this.sort.descending ? "desc" : "asc"
      };

      const vendorRes = await VendorsHttpService.getList(requestData);
      this.meta = vendorRes.meta;
      this.vendors = vendorRes.result;
    } catch (e) {
      // todo: error handling. Notifications?
    } finally {
      this.loading = false;
    }
  }
}
</script>

<style scoped></style>
