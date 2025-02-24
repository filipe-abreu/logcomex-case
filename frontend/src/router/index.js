import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import DashboardView from '../views/DashboardView.vue'
import DetailsView from '../views/DetailsView.vue'

const routes = [
  { path: '/', component: HomeView },
  { path: '/dashboard', component: DashboardView },
  { path: '/details', component: DetailsView }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
