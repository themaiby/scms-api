<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
  <div>
    <PartnerCreate v-model="isPartnerCreateOpen" @created="onPartnerCreated" />

    <SCTable
      expandable
      :headers="headers"
      :items="partners"
      :loading="loading"
      @update:options="onOptionsChange"
      @update:selected="selectedPartners = $event"
    >
      <template v-slot:header>
        <SCTableHeader
          :show-delete-button="selectedPartners.length"
          @click:add="isPartnerCreateOpen = true"
          @click:filter="1"
          @click:delete="1"
          @click:refresh="getPartnerList"
        />
      </template>

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
import { getPerPageFor, perPageOptions } from "@/utils/pagination.utils";

/** interfaces */
import { IPartner } from "@/interfaces/IPartner";
import { ITableHeader } from "@/interfaces/ITableHeader";
import { IMeta, IRequestPagination } from "@/api/interfaces";
import { ISort } from "@/interfaces/ISort";
import { ITableOptions } from "@/interfaces/ITableOptions";

/** Components */
import SCTable from "@/components/SCTable/SCTable.vue";
import SCTableHeader from "@/components/SCTableHeader/SCTableHeader.vue";
import SCTablePagination from "@/components/SCTablePagination/SCTablePagination.vue";
import PartnerCard from "./PartnerCard/PartnerCard.vue";
import PartnerCreate from "../PartnerCreate/PartnerCreate.vue";

/** Utils */
import { PartnersHttpService } from "@/api/services/partners-http.service";
import { Notify } from "@/utils/notify";
import { getTranslatedHeaders } from "@/utils/table.utils";

const perPageIdentifier = "partnerList";

@Component({
  name: "PartnerList",
  components: {
    PartnerCreate,
    PartnerCard,
    SCTablePagination,
    SCTable,
    SCTableHeader,
  }
})
export default class PartnerList extends Vue {
  public loading: boolean = false;
  public partners: IPartner[] = [];
  public selectedPartners: IPartner[] = []; // todo: batch deleting
  public perPageVariants = perPageOptions;
  public isPartnerCreateOpen = false;

  public sort: ISort = { field: "id", descending: true };
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
    { text: "description", value: "description" },
    { text: "created_at", value: "created_at" }
  ]);

  public get pagesCount() {
    return Math.ceil(this.meta.total / this.meta.per_page);
  }

  public onPartnerCreated() {
    this.isPartnerCreateOpen = false;
    this.getPartnerList();
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
    this.sort.field = options.sortBy[0];
    this.sort.descending = options.sortDesc[0];
    this.getPartnerList();
  }

  /**
   * Request builder
   */
  public async getPartnerList() {
    console.log({...this.sort});
    try {
      this.loading = true;
      const requestData: IRequestPagination = {
        perPage: this.meta.per_page,
        page: this.meta.current_page,
        sort: this.sort.field,
        direction: this.sort.descending ? "desc" : "asc"
      };

      const partnersRes = await PartnersHttpService.getList(requestData);
      this.meta = partnersRes.meta;
      this.partners = partnersRes.result;
    } catch (e) {
      Notify.error(e.data.message);
    } finally {
      this.loading = false;
    }
  }
}
</script>

<style scoped></style>
