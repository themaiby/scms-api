<template>
  <VDialog persistent :max-width="width" :value="isOpen">
    <VCard>
      <VCardTitle class="headline">{{ title }}</VCardTitle>
      <VCardText>
        {{ text }}
      </VCardText>
      <VCardActions>
        <div class="flex-grow-1"></div>
        <VBtn v-if="!loading" outlined color="primary" @click="cancel">{{ $t("cancel") }}</VBtn>
        <VBtn color="primary" :loading="loading" @click="confirm">{{ $t("confirm") }}</VBtn>
      </VCardActions>
    </VCard>
  </VDialog>
</template>

<script lang="ts">
import { Component, Emit, Prop, Vue } from "vue-property-decorator";

@Component
export default class SCDialog extends Vue {
  @Prop({ default: false }) readonly isOpen!: boolean;
  @Prop({ required: true }) readonly title!: string;
  @Prop({ required: true }) readonly text!: string;
  @Prop({ default: 250 }) readonly width!: number;
  @Prop({ default: false }) readonly loading!: boolean;

  @Emit("confirm")
  public confirm() {}

  @Emit("cancel")
  public cancel() {}
}
</script>
