import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('../views/LeaveView.vue')

  },
  {
    path: '/checkleave',
    name: 'check leave',
    component: () => import('../views/StudentView.vue')
  },
  {
    path: '/create/',
    name: 'create',
    component: () => import('../views/CreateView.vue')
  }, 
  {
    path: '/create/:id',
    name: 'email',
    component: () => import('../views/CreateView.vue')
  }, 
  {
    path: '/logout',
    name: 'logout',
    component: () => import('../views/CreateView.vue')
  }, 
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router