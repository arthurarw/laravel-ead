import { URL_API } from "@/configs";
import BaseService from "@/services/BaseService";

export default class AuthService extends BaseService {
  static async auth(params) {
    return new Promise((resolve, reject) => {
      this.request()
        .post(`${URL_API}/auth`, params)
        .then((response) => resolve(response))
        .catch((error) => reject(error.response));
    });
  }
}
