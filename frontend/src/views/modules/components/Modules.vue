<template>
  <div class="left">
    <div class="card">
      <div class="title bg-laravel">
        <span class="text">Modulos</span>
        <span class="icon far fa-stream"></span>
      </div>
      <div
        v-for="module in modules"
        :key="module.id"
        :class="['modules', module.id === showModule ? 'active' : '']"
        @click.prevent="openToggle(module.id)"
      >
        <div class="name">
          <span class="text">{{ module.name }}</span>
          <span class="icon fas fa-sort-down"></span>
        </div>
        <ul class="classes" v-show="module.id === showModule">
          <li
            :class="{ active: lesson.id === lessonPlayer.id }"
            v-for="lesson in module.lessons"
            :key="lesson.id"
            @click.prevent="setLessonInPlayer(lesson)"
          >
            <span
              v-if="lesson?.views.length > 0"
              class="check active fas fa-check"
            ></span>
            <span class="nameLesson">{{ lesson.name }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { useCourseStore } from "@/stores/CourseStore";
import { computed, ref } from "vue";

export default {
  name: "Modules",
  setup() {
    const courseStore = useCourseStore();
    const modules = computed(() => courseStore.course?.modules);
    const lessonPlayer = computed(() => courseStore.lesson);

    const showModule = ref("0");

    const openToggle = (moduleId) => {
      showModule.value = moduleId;
    };

    const setLessonInPlayer = (lesson) => {
      courseStore.lesson = lesson;
    };

    return {
      modules,
      showModule,
      openToggle,
      setLessonInPlayer,
      lessonPlayer,
    };
  },
};
</script>

<style scoped></style>
