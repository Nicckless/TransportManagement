import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
    },
    {
      path: '/cargo',
      name: 'cargo',
      component: () => import('../views/CargoView.vue'),
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
    },
    {
      path: '/trucks',
      name: 'trucks',
      component: () => import('../views/TrucksView.vue'),
    },
    {
      path: '/workers',
      name: 'workers',
      component: () => import('../views/WorkersView.vue'),
    },
  ],
})

export default router
