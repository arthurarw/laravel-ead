<template>
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
export default {
  name: "ModulesAndLessons",
  components: {
    SupportsLesson,
    Player,
    Modules,
  },
};
</script>

<style scoped></style>
