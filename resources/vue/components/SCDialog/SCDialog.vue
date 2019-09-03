<template>
  <VDialog :value="isOpen" persistent max-width="800">
    <VCard>
      <VCardTitle class="headline">{{ title }}</VCardTitle>
      <VCardText>
        {{ text }}
      </VCardText>
      <VCardActions>
        <div class="flex-grow-1"></div>
        <VBtn color="primary" outlined @click="cancel">{{ $t("cancel") }}</VBtn>
        <VBtn color="primary" @click="confirm">{{ $t("confirm") }}</VBtn>
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

  @Emit("confirm")
  public confirm() {}

  @Emit("cancel")
  public cancel() {}
}
</script>
