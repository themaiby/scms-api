const defaultPerPage = 30;
const perPageField = "perPage";

export const perPageOptions = [25, 50, 100, 200];

export const getPerPageFor = (pageID: string): number => {
  return Number(localStorage.getItem(`${perPageField}-${pageID}`)) || defaultPerPage;
};

export const setPerPageFor = (pageID: string, perPage: number): void => {
  localStorage.setItem(`${perPageField}-${pageID}`, perPage.toString());
};
