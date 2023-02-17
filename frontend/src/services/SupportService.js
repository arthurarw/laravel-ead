import BaseService from "@/services/BaseService";

export default class SupportService extends BaseService {
  static async getSupportsByLesson(lessonId) {
    return new Promise((resolve, reject) => {
      this.request({ auth: true })
        .get("/supports", {
          params: {
            lesson: lessonId,
          },
        })
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => reject(error.response));
    });
  }
  static async storeSupport(params) {
    return new Promise((resolve, reject) => {
      this.request({ auth: true })
        .post("/supports", params)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => reject(error.response));
    });
  }
  static async storeReplySupport(params) {
    return new Promise((resolve, reject) => {
      this.request({ auth: true })
        .post("/replies", params)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => reject(error.response));
    });
  }

  static async getMySupports(params) {
    return new Promise((resolve, reject) => {
      this.request({ auth: true })
        .get("/supports/me", {
          params,
        })
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => reject(error.response));
    });
  }
}
