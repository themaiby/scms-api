const tokenKey = "token";

export const persistToken = (token: string) => {
  localStorage.setItem(tokenKey, token);
};

export const getToken = (): string => {
  return localStorage.getItem(tokenKey) || "";
};

export const refreshToken = () => {};
