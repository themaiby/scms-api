<template>
  <VCard>
    <VCardTitle>
      {{ $t("contacts") }}
    </VCardTitle>

    <VProgressLinear v-if="!ready" indeterminate />
    <VCardText v-else-if="loadedPartner.contacts.length">
      <VLayout row v-for="contact in loadedPartner.contacts" :key="contact.id" ml-5>
        <VFlex xs6>
          <VLayout row>
            <VFlex xs3 shrink>
              <b>{{ contact.title }}:</b>
            </VFlex>
            <VFlex xs3>
              {{ contact.value }}
            </VFlex>
          </VLayout>
        </VFlex>
      </VLayout>
    </VCardText>
    <VCardText v-else>
      {{ $t('no-data') }}
    </VCardText>
  </VCard>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import { IPartner } from "@/Interfaces/IPartner";
import { PartnersHttpService } from "@/api/services/partners-http.service";

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
