<template>
  <div class="filter-bar">
    <input
      type="text"
      placeholder="Recherche..."
      v-model="search"
      @input="$emit('update:search', search)"
      class="filter-bar__input"
    />
    <select
      v-model="filter"
      @change="$emit('update:filter', filter)"
      class="filter-bar__select"
    >
      <option value="">Toutes catégories</option>
      <option v-for="opt in options" :key="opt" :value="opt">{{ opt }}</option>
    </select>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  options: Array
})

const search = ref('')
const filter = ref('')

watch(search, val => {
  // Already emitted via @input
})

watch(filter, val => {
  // Already emitted via @change
})
</script>

<style lang="scss" scoped>
.filter-bar {
  display: flex;
  gap: 1rem;
  margin-bottom: 1.5rem;

  &__input,
  &__select {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 1rem;
    flex: 1;

    &:focus {
      outline: none;
      border-color: #4f46e5;
      box-shadow: 0 0 5px rgba(79, 70, 229, 0.5);
    }
  }
}
</style>
