import { defineStore } from "pinia";
import AuthService from "@/services/AuthService";
import { TOKEN_NAME } from "@/configs";

export const useUserStore = defineStore("user", {
  state: () => {
    return {
      user: {
        id: "",
        name: "",
        email: "",
      },
      isLogged: false,
    };
  },
  getters: {},
  actions: {
    async auth(params) {
      return await AuthService.auth(params)
        .then((response) => {
          this.user = response.data;
          this.isLogged = true;
        })
        .catch((error) => {
          this.user.$reset();
          this.isLogged = false;
          console.log(error);
        });
    },
    async forgotPassword(email) {
      return await AuthService.forgotPassword(email);
    },
    logout() {
      this.user.$reset();
      this.isLogged = false;
      localStorage.removeItem(TOKEN_NAME);
    },
  },
});
