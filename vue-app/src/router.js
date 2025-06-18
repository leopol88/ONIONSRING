import { createRouter, createWebHistory } from 'vue-router'
import BossList from './components/BossList.vue'
import WeaponsList from './components/WeaponsList.vue'

const routes = [
  { path: '/', component: BossList },
  { path: '/armes', component: WeaponsList }
]

export default createRouter({
  history: createWebHistory(),
  routes
})
