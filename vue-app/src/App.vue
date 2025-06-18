<template>
  <main>
    <Header />
    <router-view />
  </main>
</template>

<script setup>
import Header from './components/Header.vue'
</script>

<style scoped>
main {
  max-width: 1200px;
  margin: 3rem auto;
  padding: 1rem 2rem;
}
</style>
