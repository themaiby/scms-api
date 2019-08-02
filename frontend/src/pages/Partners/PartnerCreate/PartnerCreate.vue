<template>
  <VDialog persistent :value="isOpen" @input="$emit('input', $event)" max-width="650px">
    <VCard>
      <VCardText>
        <VCardTitle>
          {{ $t("newPartner") }}
        </VCardTitle>
        <VContainer fluid grid-list-xl pb-0 mb-0>
          <VLayout row wrap>
            <VFlex xs6>
              <VTextField
                v-validate="'required'"
                name="name"
                data-vv-name="name"
                :data-vv-as="$t('name')"
                :error-messages="errors.collect('name')"
                :label="$t('name')"
                :disabled="isRequest"
                v-model="partnerModel.name"
              ></VTextField>
            </VFlex>
            <VFlex xs6>
              <VTextField
                v-validate="'required'"
                data-vv-name="description"
                :data-vv-as="$t('description')"
                :error-messages="errors.collect('description')"
                :label="$t('description')"
                :disabled="isRequest"
                v-model="partnerModel.description"
              ></VTextField>
            </VFlex>

            <template v-for="(contact, idx) in contacts">
              <VFlex xs6>
                <VTextField
                  v-validate="'required'"
                  name="contactTitle"
                  data-vv-name="contactTitle"
                  :data-vv-as="$t('contactTitle')"
                  :error-messages="errors.collect('contactTitle')"
                  :label="$t('contactTitle')"
                  :disabled="isRequest"
                  v-model="contact.title"
                />
              </VFlex>
              <VFlex xs5>
                <VTextField
                  v-validate="'required'"
                  name="contactValue"
                  data-vv-name="contactValue"
                  :data-vv-as="$t('contactValue')"
                  :error-messages="errors.collect('contactValue')"
                  :label="$t('contactValue')"
                  :disabled="isRequest"
                  v-model="contact.value"
                />
              </VFlex>
              <VFlex xs1>
                <VBtn icon tile @click="removeContactModel(idx)">
                  <VIcon>mdi-delete</VIcon>
                </VBtn>
              </VFlex>
            </template>

            <VBtn text block @click="addContactModel">+ {{ $t("addContact") }}</VBtn>
          </VLayout>

          <VDivider class="mt-4 mb-4" />

          <VCardActions>
            <VSpacer />
            <VBtn v-if="!isReqeust" color="primary" outlined @click="cancel">
              {{ $t("cancel") }}
            </VBtn>
            <VBtn color="primary" :loading="isRequest" @click="createPartner">
              {{ $t("submit") }}
            </VBtn>
          </VCardActions>
        </VContainer>
      </VCardText>
    </VCard>
  </VDialog>
</template>

<script lang="ts">
import { Component, Emit, Model, Vue } from "vue-property-decorator";
import { filter as _filter, forEach as _forEach } from "lodash";
import { PartnersHttpService } from "@/api/services/partners-http.service";
import { IPartnerCreateRequest } from "@/api/request/IPartnerCreateRequest";
import { IContactCreateRequest } from "@/api/request/IContactCreateRequest";

@Component
export default class PartnerCreate extends Vue {
  @Model("input") readonly isOpen!: boolean;

  public contacts: IContactCreateRequest[] = [];
  public isRequest = false;
  public partnerModel: IPartnerCreateRequest = {
    name: "",
    description: ""
  };

  public addContactModel() {
    this.contacts.push({ title: "", value: "" });
  }

  public removeContactModel(idx: number) {
    this.contacts = _filter(this.contacts, (contact, idxArray) => idxArray !== idx);
  }

  public async createPartner() {
    const valid = this.$validator.validateAll();
    if (!valid) return;
    this.isRequest = true;
    try {
      const partnerRes = await PartnersHttpService.create(this.partnerModel);
      const partner = partnerRes.result;

      await Promise.all(
        _forEach(this.contacts, contact => PartnersHttpService.createContact(partner.id, contact))
      );
      this.$emit("created");
    } catch (e) {
      // todo: error handling
    } finally {
      this.isRequest = false;
    }
  }

  @Emit("input")
  public cancel() {
    this.$validator.reset();
    this.contacts = [];
    this.partnerModel = { name: "", description: "" };
    return false;
  }
}
</script>

<style scoped></style>
