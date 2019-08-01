<template>
  <div>
    <VDataTable
      hide-default-footer
      class="elevation-24"
      height="80vh"
      :fixed-header="true"
      :headers="headers"
      :items="partners"
      :loading="loading"
      :page="meta.current_page"
      :items-per-page="meta.per_page"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>My CRUD</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
        </v-toolbar>
      </template>
    </VDataTable>

    <VContainer>
      <VLayout row justify-start>
        <VFlex xs12 md6 lg6 pt-4>
          <VMenu open-on-hover top offset-y>
            <template v-slot:activator="{ on }">
              <VBtn color="primary" dark v-on="on" class="text-left" :disabled="loading">
                {{ $t("perPage") }}
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
            @input="changePage"
            :length="pagesCount"
            :disabled="loading"
          />
        </VFlex>
      </VLayout>
    </VContainer>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Watch } from "vue-property-decorator";
import { PartnersHttpService } from "@/api/services/partners-http.service";

/** Interfaces */
import { IPartner } from "@/Interfaces/IPartner";
import { ITableHeader } from "@/Interfaces/ITableHeader";
import { IMeta } from "@/api/interfaces";
import { getPerPageFor } from "@/utils/pagination.utils";

@Component
export default class PartnerList extends Vue {
  public loading: boolean = false;
  public partners: IPartner[] = [];
  public perPageVariants = [10, 25, 30, 50, 100];

  public meta: IMeta = {
    current_page: 1,
    from: 1,
    to: 1,
    total: 1,
    path: "",
    last_page: 1,
    per_page: getPerPageFor("partnerList")
  };
  public headers: ITableHeader[] = [
    { text: "#", value: "id" },
    { text: "name", value: "name" },
    { text: "description", value: "description" },
    { text: "created_at", value: "created_at" }
  ];

  public get pagesCount() {
    return Math.round(this.meta.total / this.meta.per_page);
  }

  public changePage(page: number) {
    this.meta.current_page = page;
    this.getPartnersList();
  }

  public changePerPage(perPage: number) {
    this.meta.per_page = perPage;
    this.getPartnersList();
  }

  public async getPartnersList() {
    try {
      this.loading = true;
      const partnersRes = await PartnersHttpService.getList({
        perPage: this.meta.per_page,
        page: this.meta.current_page
      });

      this.meta = partnersRes.meta;
      this.partners = partnersRes.result;
    } catch (e) {
      // todo: error handling
    } finally {
      this.loading = false;
    }
  }

  public mounted() {
    this.getPartnersList();
  }
}
</script>

<style scoped></style>
