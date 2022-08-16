import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('../views/HomeView.vue')

  },
  {
    path: '/2022a',
    name: 'weba',
    component: () => import('../views/AboutView.vue')
  },
  {
    path: '/2022b',
    name: 'webb',
    component: () => import('../views/AboutView.vue')
  },
  {
    path: '/2022sna',
    name: 'sna',
    component: () => import('../views/AboutView.vue')
  }, 
  {
    path: '/checkleave',
    name: 'check leave',
    component: () => import('../views/AboutView.vue')
  }, 
  {
    path: '/logout',
    name: 'logout',
    component: () => import('../views/AboutView.vue')
  }, 
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router