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

    async storeReplySupport(params) {
      return await SupportService.storeReplySupport(params)
        .then((response) => {
          const supports = this.supports.data;
          const supportId = response.data.support_id;

          supports.forEach((support, index) => {
            if (support.id === supportId) {
              supports[index].replies.push(response.data);
            }
          });

          this.supports.data = supports;
        })
        .catch((error) => console.log(error));
    },

    async getMySupports(params) {
      return await SupportService.getMySupports(params)
        .then((response) => {
          this.supports = response;
        })
        .catch((error) => console.log(error));
    },
  },
});
