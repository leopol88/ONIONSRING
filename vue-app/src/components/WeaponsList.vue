<template>
  <div class="weapon-list">
    <div class="filters">
      <select v-model="selectedType">
        <option value="">Tous les types</option>
        <option v-for="type in weaponTypes" :key="type">{{ type }}</option>
      </select>
      <input type="text" v-model="searchQuery" placeholder="Rechercher une arme..." />
    </div>

    <div class="grid">
      <div
        class="card"
        v-for="weapon in filteredWeapons"
        :key="weapon.post_title"
        @click="openModal(weapon)"
      >
        <img :src="weapon.image_arme" :alt="weapon.post_title" />
        <div class="card-content">
          <h2>{{ weapon.post_title }}</h2>
          <p><strong>Type:</strong> {{ weapon.type_arme }}</p>
          <p class="lore-text">{{ weapon.lore_arme?.slice(0, 100) + '…' }}</p>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="selectedWeapon" class="modal-backdrop" @click.self="selectedWeapon = null">
      <div class="modal">
        <h2>{{ selectedWeapon.post_title }}</h2>
        <img :src="selectedWeapon.image_arme" :alt="selectedWeapon.post_title" />
        <p><strong>Dégâts physiques:</strong> {{ selectedWeapon.degats_physiques }}</p>
        <p><strong>Feu:</strong> {{ selectedWeapon.degats_feu }}</p>
        <p><strong>Foudre:</strong> {{ selectedWeapon.degats_foudre }}</p>
        <p><strong>Foi:</strong> {{ selectedWeapon.degats_foi }}</p>
        <p><strong>Critique:</strong> {{ selectedWeapon.critique }}</p>
        <p><strong>Type:</strong> {{ selectedWeapon.type_arme }}</p>
        <p><strong>Lore:</strong> {{ selectedWeapon.lore_arme }}</p>
        <button @click="selectedWeapon = null">Fermer</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const weapons = ref([])
const searchQuery = ref('')
const selectedType = ref('')
const selectedWeapon = ref(null)

const filteredWeapons = computed(() => {
  return weapons.value.filter(w => {
    const matchSearch = w.post_title?.toLowerCase().includes(searchQuery.value.toLowerCase())
    const matchType = selectedType.value === '' || w.type_arme === selectedType.value
    return matchSearch && matchType
  })
})

const weaponTypes = computed(() => {
  const types = new Set()
  weapons.value.forEach(w => {
    if (w.type_arme) types.add(w.type_arme)
  })
  return Array.from(types)
})

const openModal = (weapon) => {
  selectedWeapon.value = weapon
}

onMounted(async () => {
  try {
    const res = await fetch('https://sae401-25.mmi-stdie.fr/leopaula/wp-json/wp/v2/armes')
    if (!res.ok) throw new Error('Erreur lors du chargement des armes')
    weapons.value = await res.json()
  } catch (err) {
    console.error('Erreur fetch armes:', err)
  }
})
</script>

<style scoped lang="scss">
.weapon-list {
  max-width: 1280px;
  margin: auto;
  padding: 2rem;
  color: white;
}

.filters {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;

  select,
  input {
    padding: 0.5rem;
    border-radius: 0.5rem;
    border: none;
    width: 100%;
    background-color: #2c2c2c; // Fond foncé
    color: #f0f0f0;            // Texte clair
    border: 1px solid #7a7050; // Bordure dorée
  }

  select::placeholder,
  input::placeholder {
    color: #aaa;
  }
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1.5rem;
}

.card {
  background: rgba(11, 10, 10, 0.95);
  color: #eee9db;
  border: 2px solid #7a7050;
  border-radius: 12px;
  box-shadow: 0 0 12px rgba(0, 0, 0, 0.6);
  overflow: hidden;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.3s ease;

  &:hover {
    transform: scale(1.02);
    box-shadow: 0 0 20px #d4af37;
  }

  img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 2px solid #7a7050;
  }

  .card-content {
    padding: 1rem 1.5rem;

    h2 {
      font-family: 'Cinzel', serif;
      font-size: 1.25rem;
      font-weight: 700;
      color: #d4af37;
      margin-bottom: 0.5rem;
    }

    p {
      margin: 0.25rem 0;
      font-size: 0.9rem;
      color: #7a7050;
    }

    p strong {
      color: #d4af37;
    }

    .lore-text {
      margin-top: 0.5rem;
      font-style: italic;
      color: #eee9db;
    }
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
