import axios from "axios";
import { interceptors } from "@/api/interceptors";

export const api = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL
});

api.interceptors.request.use(interceptors.request.onSuccess, interceptors.request.onError);
api.interceptors.response.use(interceptors.response.onSuccess, interceptors.response.onError);
