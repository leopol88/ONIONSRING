<template>
  <div class="boss-list">
    <div class="filters">
      <select v-model="selectedCategory">
        <option value="">Toutes les catégories</option>
        <option v-for="cat in categories" :key="cat">{{ cat }}</option>
      </select>
      <input type="text" v-model="searchQuery" placeholder="Rechercher un boss..." />
    </div>

    <div class="grid">
      <BossCard
        v-for="boss in filteredBosses"
        :key="boss.id"
        :boss="boss"
        @open="openModal"
      />
    </div>

    <!-- Modal -->
    <div v-if="selectedBoss" class="modal-backdrop" @click.self="closeModal">
      <div class="modal">
        <h2>{{ selectedBoss.post_title }}</h2>
        <img :src="selectedBoss.image_boss" :alt="selectedBoss.post_title" />
        <p><strong>PV:</strong> {{ selectedBoss.pv_boss }}</p>
        <p><strong>Faiblesses:</strong> {{ selectedBoss.faiblesses }}</p>
        <p><strong>Résistance:</strong> {{ selectedBoss.resistance }}</p>
        <p><strong>Lore:</strong> {{ selectedBoss.lore }}</p>
        <button @click="closeModal">Fermer</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import BossCard from './BossCard.vue'

const bosses = ref([])
const searchQuery = ref('')
const selectedCategory = ref('')
const selectedBoss = ref(null)

const filteredBosses = computed(() => {
  return bosses.value.filter(boss => {
    const matchSearch = boss.post_title?.toLowerCase().includes(searchQuery.value.toLowerCase())
    const matchCat = selectedCategory.value === '' || boss.categorie_boss === selectedCategory.value
    return matchSearch && matchCat
  })
})

const categories = computed(() => {
  const cats = new Set()
  bosses.value.forEach(boss => {
    if (boss.categorie_boss) cats.add(boss.categorie_boss)
  })
  return Array.from(cats)
})

const openModal = (boss) => {
  selectedBoss.value = boss
}

const closeModal = () => {
  selectedBoss.value = null
}

onMounted(async () => {
  try {
    const res = await fetch('https://sae401-25.mmi-stdie.fr/leopaula/wp-json/wp/v2/boss')
    if (!res.ok) throw new Error('Erreur lors du chargement des données')
    bosses.value = await res.json()
    console.log('Données chargées', bosses.value)
  } catch (err) {
    console.error('Erreur fetch:', err)
  }
})
</script>

<style scoped lang="scss">
.boss-list {
  max-width: 1280px;
  margin: auto;
  padding: 2rem;
  color: white;
}

.filters {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;
  select, input {
    padding: 0.5rem;
    border-radius: 0.5rem;
    border: none;
    width: 100%;
  }
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1.5rem;
}
.filters {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;

  select, input {
    padding: 0.5rem;
    border-radius: 0.5rem;
    border: none;
    width: 100%;
    background-color: #2c2c2c; // FOND FONCÉ
    color: #f0f0f0;            // TEXTE CLAIR
    border: 1px solid #7a7050; // Optionnel : bordure dorée
  }

  select::placeholder,
  input::placeholder {
    color: #aaa; // Couleur du placeholder
  }
}

.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(15, 15, 15, 0.85);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;
}

.modal {
  background: #1f1f1f;
  color: #f0f0f0;
  padding: 2rem;
  border-radius: 1rem;
  max-width: 600px;
  width: 90%;
  text-align: left;
  button {
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    background: #ddb54d;
    color: #000;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
  }
  img {
    width: 100%;
    margin: 1rem 0;
    border-radius: 1rem;
  }
}
</style>
