import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('../views/SocialOffairView.vue')

  },
  {
    path: '/checkleave',
    name: 'check leave',
    component: () => import('../views/NotificationView.vue')
  },
  {
    path: '/create',
    name: 'create',
    component: () => import('../views/StudentView.vue')
  }, 
  {
    path: '/logout',
    name: 'logout',
    component: () => import('../views/StudentView.vue')
  }, 
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router