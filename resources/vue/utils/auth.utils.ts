import { UserModule } from "../store/modules/user-module";
import { RefreshStatusEnum } from "../store/modules/user-module/interfaces";
import { AuthHttpService } from "../api/services/auth-http.service";
import { includes as _includes } from "lodash";

const tokenKey = "token";

/**
 * Save token to localStorage
 * @param token
 */
export const persistToken = (token: string) => {
  localStorage.setItem(tokenKey, token);
};

/**
 * get token from localStorage
 */
export const getToken = (): string => {
  return localStorage.getItem(tokenKey) || "";
};

const setRefreshSuccess = (token: string): void => {
  persistToken(token);
  UserModule.setRefreshStatus(RefreshStatusEnum.success);
  UserModule.setAuthenticated(true);
};

const setRefreshError = (): void => {
  UserModule.setRefreshStatus(RefreshStatusEnum.error);
  UserModule.setAuthenticated(false);
};

/**
 * Refresh attempt if not failed already
 */
export const refreshToken = async () => {
  if (!getToken()) {
    setRefreshError();
  }

  const dontCheckStatuses = [RefreshStatusEnum.refresh, RefreshStatusEnum.error];
  const currentStatus = UserModule.refreshStatus;

  if (!_includes(dontCheckStatuses, currentStatus)) {
    UserModule.setRefreshStatus(RefreshStatusEnum.refresh);
    try {
      const authData = await AuthHttpService.refreshToken();
      setRefreshSuccess(authData.access_token);
      return Promise.resolve();
    } catch (e) {
      setRefreshError();
      return Promise.reject(e);
    }
  }
};
