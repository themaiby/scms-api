import { getModule, VuexModule } from "vuex-module-decorators";

class Vendors extends VuexModule {}

export const VendorsModule = getModule(Vendors);
