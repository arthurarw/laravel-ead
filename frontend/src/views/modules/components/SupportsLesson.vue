<template>
  <div class="comments" v-show="lesson.name">
    <div class="header">
      <span class="title"
        >Dúvidas (total: {{ supports.length }})
        <span v-if="loading">Carregando...</span></span
      >
      <button class="btn primary" @click.prevent="modal.showModal = true">
        <i class="fas fa-plus"></i>
        Enviar nova dúvida
      </button>
    </div>
    <supports />
    <support-modal
      @close-modal="modal.showModal = false"
      :show-modal="modal.showModal"
      :support-reply="modal.supportReply"
    />
  </div>
</template>

<script>
import Supports from "@/components/Supports.vue";
import { useCourseStore } from "@/stores/CourseStore";
import { computed, watch, ref } from "vue";
import { useSupportStore } from "@/stores/SupportStore";
import SupportModal from "@/components/SupportModal.vue";

export default {
  name: "SupportsLesson",
  components: { Supports, SupportModal },
  setup() {
    const courseStore = useCourseStore();
    const supportStore = useSupportStore();

    const lesson = computed(() => courseStore.lesson);
    const supports = computed(() => supportStore.supports.data);

    const loading = ref(false);

    const modal = ref({
      showModal: false,
      supportReply: "",
    });

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
      modal,
    };
  },
};
</script>

<style scoped></style>
