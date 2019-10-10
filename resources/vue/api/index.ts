import axios from "axios";
import { interceptors } from "./interceptors";


export const api = axios.create({ baseURL: '/api/v1'});

api.interceptors.request.use(interceptors.request.onSuccess, interceptors.request.onError);
api.interceptors.response.use(interceptors.response.onSuccess, interceptors.response.onError);
