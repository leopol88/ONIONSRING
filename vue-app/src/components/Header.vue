<template>
  <header class="app-header">
    <nav>
      <router-link to="/" exact-active-class="active">Boss</router-link>
      <router-link to="/armes" exact-active-class="active">Armes</router-link>
    </nav>
  </header>
</template>

<script setup></script>

<style scoped lang="scss">
.app-header {
  background: rgba(0, 0, 0, 0.7);
  padding: 1rem;
  text-align: center;
  nav {
    display: flex;
    justify-content: center;
    gap: 2rem;
    a {
      color: #d4af37;
      text-decoration: none;
      font-weight: bold;
      font-family: 'Cinzel', serif;
      transition: color 0.3s;
      &.active, &:hover {
        color: #fff;
      }
    }
  }
}
</style>
