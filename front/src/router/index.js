import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'login',
    component: () => import('../views/LoginView.vue'),
    meta: {
      hideNavbar: true,
    }
  },
  {
    path: '/logout',
    name: 'logout',
    component: () => import('../views/LoginView.vue'),
    meta: {
      logout: true,
    }
  },
  {
    path: '/students',
    name: 'students',
    component: () => import('../views/StudentView.vue')
  },
  {
    path: '/create',
    name: 'create',
    component: () => import('../views/CreateView.vue')
  }, 
  {
    path: '/leave',
    name: 'home',
    component: () => import('../views/LeaveView.vue')
  }, 
  {
    path: '/create/:id',
    name: 'email',
    component: () => import('../views/CreateView.vue')
  }, 
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router