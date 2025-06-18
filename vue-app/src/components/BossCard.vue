<template>
  <div class="boss-card" @click="$emit('open', boss)">
    <img :src="boss.image_boss" :alt="boss.post_title" class="boss-img" />
    <div class="boss-content">
      <h2 class="boss-title">{{ boss.post_title }}</h2>
      <p class="boss-pv"><strong>PV:</strong> {{ boss.pv_boss }}</p>
      <p class="boss-type"><strong>Faiblesses:</strong> {{ boss.faiblesses }}</p>
      <p class="boss-type"><strong>Résistances:</strong> {{ boss.resistance }}</p>
      <p class="boss-lore">{{ loreExcerpt }}</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  boss: Object
})

const loreExcerpt = computed(() => {
  const maxLength = 80
  return props.boss.lore?.length > maxLength
    ? props.boss.lore.slice(0, maxLength) + '…'
    : props.boss.lore
})
</script>

<style scoped lang="scss">
.boss-card {
  background: rgba(11, 10, 10, 0.95); // fond noir semi-transparent
  color: #eee9db;
  border: 2px solid #7a7050;
  border-radius: 12px;
  box-shadow: 0 0 12px rgba(0, 0, 0, 0.6);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.3s ease;

  &:hover {
    transform: scale(1.02);
    box-shadow: 0 0 20px #d4af37;
  }
}

.boss-img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-bottom: 2px solid #7a7050;
}

.boss-content {
  padding: 1rem 1.5rem;
  flex-grow: 1;

  p {
    margin: 0.25rem 0;
    font-size: 0.9rem;
    color: #7a7050;
  }

  p strong {
    color: #d4af37;
    font-weight: bold;
  }

  .boss-lore {
    margin-top: 0.5rem;
    font-style: italic;
    color: #eee9db;
  }
}

.boss-title {
  font-family: 'Cinzel', serif;
  font-size: 1.25rem;
  font-weight: 700;
  color: #d4af37;
  margin-bottom: 0.5rem;
}
</style>
