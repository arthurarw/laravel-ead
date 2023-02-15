import { defineStore } from "pinia";
import SupportService from "@/services/SupportService";

export const useSupportStore = defineStore("support", {
  state: () => {
    return {
      supports: {
        data: [],
        meta: {
          total: 0,
          page: 1,
          per_page: 10,
          last_page: 1,
        },
      },
      userSupports: [],
    };
  },
  getters: {},
  actions: {
    async getSupports(lessonId) {
      return await SupportService.getSupportsByLesson(lessonId)
        .then((response) => {
          this.supports = Object.assign({}, this.supports, response);
          // this.supports.meta = response.meta;
        })
        .catch((error) => console.log(error));
    },

    async storeSupport(params) {
      return await SupportService.storeSupport(params)
        .then((response) => {
          this.addNewSupport(response.data);
        })
        .catch((error) => console.log(error));
    },

    addNewSupport(support) {
      this.supports.data.unshift(support);
    },

    clearSupports() {
      this.supports.$reset();
    },
  },
});
