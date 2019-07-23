import { AxiosResponse } from "axios";

const handleRequestSuccess = (config: object) => {
  return config;
};

const handleResponseSuccess = (response: AxiosResponse) => {
  const status = response.status;
  switch (status) {
    case 401:
      // todo: login?
      break;
    case 500:
      // todo: notification
      break;
  }
  return response;
};

const handleError = (error: any) => {
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
