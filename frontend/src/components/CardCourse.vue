<template>
  <li>
    <span :class="['card', 'bg-' + bgName]">
      <span class="icon">
        <img
          :src="course.image ? course.image : defaultLogo"
          :alt="course.name"
        />
      </span>
      <span class="title">{{ course.name }}</span>
      <span class="action">
        <a href="#" :class="['btn', bgName]" @click.prevent="setCourse"
          >Acessar</a
        >
      </span>
    </span>
    <span class="dots">
      <span></span>
      <span></span>
      <span></span>
    </span>
  </li>
</template>

<script>
import { useCourseStore } from "@/stores/CourseStore";
import router from "@/router";
import defaultLogo from "@/assets/images/icons/default.png";

export default {
  name: "CardCourse",
  props: ["course", "bgName"],
  setup(props) {
    const courseStore = useCourseStore();
    const setCourse = () => {
      courseStore.course = props.course;

      router.push({ name: "campus.modules" });
    };

    return {
      setCourse,
      defaultLogo,
    };
  },
};
</script>

<style scoped></style>
