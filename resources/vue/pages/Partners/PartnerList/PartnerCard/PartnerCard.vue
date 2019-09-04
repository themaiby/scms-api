<template>
  <VCard>
    <VCardTitle>
      {{ $t("description") }}
    </VCardTitle>
    <VCardText>
      {{ partner.description }}
    </VCardText>

    <VCardTitle>
      {{ $t("contacts") }}
    </VCardTitle>

    <VProgressLinear v-if="!ready" indeterminate height="2" />
    <VCardText v-else-if="loadedPartner.contacts.length">
      <VList dense v-for="contact in loadedPartner.contacts" :key="contact.id">
        <VListItem @click="toClipBoard(contact.value)">
          <VListItemContent>
            <VListItemTitle v-text="contact.title" />
            <VListItemSubtitle v-text="contact.value" />
          </VListItemContent>
        </VListItem>
      </VList>
    </VCardText>
    <VCardText v-else>
      {{ $t("no-data") }}
    </VCardText>
  </VCard>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import { IPartner } from "@/interfaces/IPartner";
import { PartnersHttpService } from "@/api/services/partners-http.service";
import { Notify } from "@/utils/notify";
import { toClipBoard } from "@/plugins/v-clipboard";

@Component
export default class PartnerCard extends Vue {
  @Prop({ required: true }) readonly partner!: IPartner;

  public ready = false;
  public loadedPartner: IPartner = {
    active: false,
    contacts: [],
    created_at: "",
    description: "",
    id: 0,
    name: "",
    updated_at: "",
    user_id: ""
  };

  public toClipBoard(value: string) {
    toClipBoard(value);
    Notify.info(this.$t("copiedToClipboard") as string);
  }

  public async mounted() {
    try {
      const partnerRes = await PartnersHttpService.get(this.partner.id);
      this.loadedPartner = partnerRes.result;
    } catch (e) {
      // todo: error handling
    } finally {
      this.ready = true;
    }
  }
}
</script>

<style scoped></style>
