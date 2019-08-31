import { AxiosRequestConfig, AxiosResponse } from "axios";
import { getToken, refreshToken } from "../utils/auth.utils";

const handleRequestSuccess = (config: AxiosRequestConfig) => {
  config.headers.Authorization = `Bearer ${getToken()}`;
  return config;
};

const handleResponseSuccess = async (response: AxiosResponse) => {
  return response;
};

const handleError = async (error: any) => {
  const status = error.response.status;
  switch (status) {
    case 401:
      const refreshed = await refreshToken();
      break;
    case 500:
      // todo: notification
      break;
  }

  return Promise.reject(error);
};

export const interceptors = {
  request: {
    onSuccess: handleRequestSuccess,
    onError: handleError
  },
  response: {
    onSuccess: handleResponseSuccess,
    onError: handleError
  }
};
