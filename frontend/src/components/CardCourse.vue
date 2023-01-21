<template>
  <div>
    <li>
      <span :class="['card', 'bg-' + bgName]">
        <span class="icon">
          <img
            :src="image"
            :alt="title"
          />
        </span>
        <span class="title">{{ title }}</span>
        <span class="action">
          <a href="trainings.html" class="btn laravel">Acessar</a>
        </span>
      </span>
      <span class="dots">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </li>
  </div>
</template>

<script>
export default {
  name: "CardCourse",
  props: ["title", "image", "bgName"],
};
</script>

<style scoped></style>
