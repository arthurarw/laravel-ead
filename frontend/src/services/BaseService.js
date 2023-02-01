import Http from "@/services/Http.init";

export default class BaseService {
  constructor() {
    this.instance = new BaseService();
  }
  static request(status = { auth: false }) {
    return new Http(status);
  }
}
