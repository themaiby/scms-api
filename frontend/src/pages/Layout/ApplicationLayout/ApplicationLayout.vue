<template>
  <div>
    <VToolbar app color="yellow lighten-5">
      <VToolbarTitle> SCMS </VToolbarTitle>
      <VDivider class="mx-3" inset vertical />
      <span class="subheading">{{ $t($route.meta.title) }}</span>

      <v-spacer></v-spacer>

      <VToolbarItems>
        <template v-for="link in links">
          <VDivider vertical />
          <VBtn :to="{ name: link.name }" flat>
            <VIcon v-if="link.icon">{{ link.icon }}</VIcon>
            <span v-else>{{ $t(link.title) }}</span>
          </VBtn>
        </template>
      </VToolbarItems>
    </VToolbar>
    <VContent>
      <VContainer fluid>
        <router-view></router-view>
      </VContainer>
    </VContent>
  </div>
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

<style scoped></style>
