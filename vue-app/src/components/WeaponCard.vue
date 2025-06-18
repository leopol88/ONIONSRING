<template>
  <div class="weapon-card" @click="$emit('open', weapon)">
    <img :src="weapon.image_arme" :alt="weapon.post_title" class="weapon-img" />
    <div class="weapon-content">
      <h2 class="weapon-title">{{ weapon.post_title }}</h2>
      <p><strong>Type:</strong> {{ weapon.type_arme }}</p>
      <p class="weapon-lore">{{ loreExcerpt }}</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  weapon: Object
})

const loreExcerpt = computed(() => {
  const max = 100
  return props.weapon.lore_arme?.length > max
    ? props.weapon.lore_arme.slice(0, max) + '…'
    : props.weapon.lore_arme
})
</script>

<style scoped lang="scss">
.weapon-card {
  background: rgba(20, 20, 20, 0.9);
  color: #eee;
  border: 2px solid #7a7050;
  border-radius: 12px;
  overflow: hidden;
  cursor: pointer;
  transition: 0.2s ease;
  &:hover {
    transform: scale(1.02);
    box-shadow: 0 0 12px #d4af37;
  }
}
.weapon-img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}
.weapon-content {
  padding: 1rem;
  p {
    margin: 0.25rem 0;
    color: #ccc;
    strong {
      color: #d4af37;
    }
  }
  .weapon-lore {
    font-style: italic;
    color: #bbb;
  }
}
.weapon-title {
  font-family: 'Cinzel', serif;
  font-size: 1.25rem;
  font-weight: bold;
  color: #d4af37;
}
</style>
