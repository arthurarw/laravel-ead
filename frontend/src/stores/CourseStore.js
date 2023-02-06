import { defineStore } from "pinia";
import CourseService from "@/services/CourseService";

export const useCourseStore = defineStore("course", {
  state: () => {
    return {
      courses: [],
    };
  },
  getters: {},
  actions: {
    async getCourses() {
      return await CourseService.getCourses()
        .then((response) => (this.courses = response.data))
        .catch((error) => console.log(error));
    },
  },
});
