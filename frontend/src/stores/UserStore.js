import { defineStore } from "pinia";
import AuthService from "@/services/AuthService";
import {TOKEN_NAME} from "@/configs";

export const useUserStore = defineStore("user", {
  state: () => {
    return {
      countUsers: 3,
      user: {
        id: "",
        name: "",
        email: "",
      },
      isLogged: false,
    };
  },
  getters: {
    getCountUsers: (state) => {
      return state.countUsers;
    },
  },
  actions: {
    incrementUsers() {
      this.countUsers++;
    },
    async auth(params) {
      await AuthService.auth(params);
    },
    logout() {
      this.user.$reset();
      this.isLogged = false;
      localStorage.removeItem(TOKEN_NAME);
    },
  },
});
