import { URL_API, TOKEN_NAME } from "@/configs";
import BaseService from "@/services/BaseService";

export default class AuthService extends BaseService {
  static async auth(params) {
    return new Promise((resolve, reject) => {
      this.request()
        .post(`${URL_API}/auth`, params)
        .then((response) => {
          localStorage.setItem(TOKEN_NAME, response.data.token);
          resolve(response);
        })
        .catch((error) => reject(error.response));
    });
  }
  static async forgotPassword(email) {
    return new Promise((resolve, reject) => {
      this.request()
        .post(`${URL_API}/forgot-password`, {
          email,
        })
        .then((response) => {
          resolve(response);
        })
        .catch((error) => reject(error.response));
    });
  }
}
