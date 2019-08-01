<template>
  <VContainer fluid>
    <VContent fluid>
      <VAppBar app color="primary" dark>
        <VToolbarTitle> SCMS </VToolbarTitle>
        <VDivider class="mx-3" inset vertical />
        <span class="subheading">{{ $t($route.meta.title) }}</span>

        <v-spacer></v-spacer>

        <VToolbarItems>
          <template v-for="(link, idx) in links">
            <VDivider vertical :key="'divider-' + idx" />
            <VBtn :key="'button-' + idx" :to="{ name: link.name }" text style="text-transform: none">
              <VIcon v-if="link.icon">{{ link.icon }}</VIcon>
              <span v-else>{{ $t(link.title) }}</span>
            </VBtn>
          </template>
        </VToolbarItems>
      </VAppBar>
      <router-view></router-view>
    </VContent>
  </VContainer>
</template>

<script lang="ts">
import { Component, Vue, Watch } from "vue-property-decorator";
import { UserModule } from "@/store/modules/user-module";

@Component
export default class ApplicationLayout extends Vue {
  public links: { name: string; title: string; icon?: string }[] = [
    { name: "main", title: "main" },
    { name: "orders.list", title: "orders" },
    { name: "vendors.list", title: "vendors" },
    { name: "partners.list", title: "partners" },
    { name: "components.list", title: "components" },
    { name: "settings", title: "settings", icon: "mdi-settings" }
  ];
  private checkAuth() {
    if (!UserModule.authenticated) {
      this.$router.push({ name: "login" });
    }
  }

  get userAuthenticated() {
    return UserModule.authenticated;
  }

  @Watch("userAuthenticated") triggerCheckAuth() {
    this.checkAuth();
  }

  private created() {
    this.checkAuth();
  }
}
</script>

<style scoped>
.container-full {
  height: 100%;
}
</style>
