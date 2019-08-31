import { ITableHeader } from "../interfaces/ITableHeader";
import { map as _map } from "lodash";
import { i18n } from "../plugins/i18n";

export const getTranslatedHeaders = (headers: ITableHeader[]): ITableHeader[] => {
  return _map(headers, header => {
    return { ...header, text: i18n.t(header.text) as string };
  });
};

