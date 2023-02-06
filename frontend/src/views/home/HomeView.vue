<template>
  <div class="pageTitle">
    <span class="title">Meus Cursos</span>
    <span class="dots">
      <span></span>
      <span></span>
      <span></span>
    </span>
  </div>

  <div class="content">
    <ul class="listCourses">
      <card-course
        v-for="course in courses"
        :key="course.id"
        :course="course"
        :bg-name="'laravel'"
      />
    </ul>
  </div>
</template>

<script>
import CardCourse from "@/components/CardCourse.vue";
import { onMounted, computed } from "vue";
import { useCourseStore } from "@/stores/CourseStore";
export default {
  name: "HomeView",
  components: {
    CardCourse,
  },
  setup() {
    const courseStore = useCourseStore();

    const courses = computed(() => courseStore.courses);

    onMounted(() => {
      courseStore.getCourses();
    });

    return {
      courses,
    };
  },
};
</script>
