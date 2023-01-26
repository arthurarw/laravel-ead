<template>
  <header id="header">
    <nav>
      <span class="toggleMenu far fa-bars"></span>
      <span class="logo">
        <router-link :to="{ name: 'campus.home' }">
          <img src="#" alt="Vue.js 3 - EAD" />
        </router-link>
      </span>
    </nav>
  </header>
</template>

<script>
export default {
  name: "header-component",
};
</script>
