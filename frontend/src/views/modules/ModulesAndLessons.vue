<template>
  <div>
    <div class="pageTitle">
      <span class="title">{{ course.name }}</span>
      <span class="dots">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </div>
  </div>

  <div class="content">
    <div class="container">
      <modules />
      <div class="right">
        <div class="content">
          <player />
          <supports-lesson />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Modules from "@/views/modules/components/Modules.vue";
import Player from "@/views/modules/components/Player.vue";
import SupportsLesson from "@/views/modules/components/SupportsLesson.vue";
import { useCourseStore } from "@/stores/CourseStore";
import { computed } from "vue";
export default {
  name: "ModulesAndLessons",
  components: {
    SupportsLesson,
    Player,
    Modules,
  },
  setup() {
    const courseStore = useCourseStore();
    const course = computed(() => courseStore.course);

    return {
      course,
    };
  },
};
</script>

<style scoped></style>
