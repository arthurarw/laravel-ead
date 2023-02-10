<template>
  <div class="comments" v-show="lesson.name">
    <div class="header">
      <span class="title"
        >Dúvidas (total: {{ supports.length }})
        <span v-if="loading">Carregando...</span></span
      >
      <button class="btn primary">
        <i class="fas fa-plus"></i>
        Enviar nova dúvida
      </button>
    </div>
    <supports />
  </div>
</template>

<script>
import Supports from "@/components/Supports.vue";
import { useCourseStore } from "@/stores/CourseStore";
import { computed, watch, ref } from "vue";
import { useSupportStore } from "@/stores/SupportStore";

export default {
  name: "SupportsLesson",
  components: { Supports },
  setup() {
    const courseStore = useCourseStore();
    const supportStore = useSupportStore();

    const lesson = computed(() => courseStore.lesson);
    const supports = computed(() => supportStore.supports.data);

    const loading = ref(false);

    watch(
      () => courseStore.lesson,
      () => {
        loading.value = true;
        supportStore
          .getSupports(lesson.value.id)
          .finally(() => (loading.value = false));
      }
    );

    return {
      lesson,
      loading,
      supports,
    };
  },
};
</script>

<style scoped></style>
