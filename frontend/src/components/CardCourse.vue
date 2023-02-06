<template>
  <li>
    <span :class="['card', 'bg-' + bgName]">
      <span class="icon">
        <img
          :src="[
            course.image !== ''
              ? course.image
              : require('@/assets/images/icons/default.png'),
          ]"
          :alt="course.name"
        />
      </span>
      <span class="title">{{ course.name }}</span>
      <span class="action">
        <router-link :to="{ name: 'campus.modules' }" :class="['btn', bgName]">
          Acessar
        </router-link>
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
export default {
  name: "CardCourse",
  props: ["course", "bgName"],
};
</script>

<style scoped></style>
