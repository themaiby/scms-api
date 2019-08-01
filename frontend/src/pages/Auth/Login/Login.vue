<template>
  <VContainer fluid fill-height>
    <VLayout align-center justify-center>
      <VFlex xs12 sm8 md4 lg4>
        <VCard class="elevation-12 white">
          <VCardTitle>
            <h2>{{ $t($route.meta.title) }}</h2>
          </VCardTitle>
          <VCardText>
            <!-- Email -->
            <VTextField
              solo
              v-model="email"
              name="email"
              v-validate="'required|email'"
              data-vv-validate-on="blur"
              data-vv-name="email"
              :data-vv-as="$t('field.email')"
              :error-messages="errors.collect('email')"
              :label="$t('field.email')"
              :disabled="isRequest"
              @keydown.enter.native="loginAttempt"
            />

            <!-- Password -->
            <VTextField
              solo
              v-model="password"
              name="password"
              v-validate="'required'"
              data-vv-validate-on="blur"
              data-vv-name="password"
              :data-vv-as="$t('field.password')"
              :error-messages="errors.collect('password')"
              :label="$t('field.password')"
              :disabled="isRequest"
              @keydown.enter.native="loginAttempt"
              type="password"
            />
          </VCardText>
          <VCardText>
            <VAlert color="error" icon="mdi-alert" outline :value="error">
              {{ error }}
            </VAlert>
          </VCardText>
          <VCardActions>
            <VSpacer />
            <VBtn v-if="!isRequest" @click="clear" color="primary" flat>
              {{ $t("action.clear") }}
            </VBtn>
            <VBtn :loading="isRequest" @click="loginAttempt" color="primary">
              {{ $t("action.login") }}
            </VBtn>
          </VCardActions>
        </VCard>
      </VFlex>
    </VLayout>
  </VContainer>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { AuthHttpService } from "@/api/services/auth-http.service";
import { persistToken } from "@/utils/auth.utils";
import { UserModule } from "@/store/modules/user-module";

@Component
export default class Login extends Vue {
  public email = "";
  public password = "";
  public isRequest = false;
  public error = "";

  public async loginAttempt() {
    const validated = await this.$validator.validateAll();
    if (validated) {
      this.isRequest = true;
      this.error = "";
      try {
        const loginData = await AuthHttpService.login(this.email, this.password);
        persistToken(loginData.access_token);
        UserModule.setAuthenticated(true);
        this.$router.push({ name: "layout" });
      } catch (e) {
        this.error = e.response.data.message;
      } finally {
        this.isRequest = false;
      }
    }
  }

  private clear() {
    this.$validator.reset();
    this.email = "";
    this.password = "";
  }
}
</script>

<style scoped></style>
