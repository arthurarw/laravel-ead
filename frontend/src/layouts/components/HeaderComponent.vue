<template>
  <header id="header">
    <nav>
      <span class="toggleMenu far fa-bars"></span>
      <span class="logo">
        <router-link :to="{ name: 'campus.home' }">
          <img :src="Logo" alt="EspecializaTi" />
        </router-link>
      </span>
    </nav>
  </header>
</template>

<script>
import Logo from "@/assets/images/logo.svg";

export default {
  name: "header-component",
  setup() {
    return {
      Logo,
    };
  },
};
</script>
