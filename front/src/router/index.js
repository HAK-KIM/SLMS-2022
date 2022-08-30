import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'login',
    component: () => import('../views/LoginView.vue'),
    meta: {
      hideNavbar: true,
      logout: true,
    }
  },
  {
    path: '/loginAdmin',
    name: 'loginAdmin',
    component: () => import('../views/LoginView.vue'),
    meta: {
      hideNavbar: true,
      isAdmin: true,
    }
  },
  {
    path: '/students',
    name: 'students',
    component: () => import('../views/StudentView.vue'),
    meta: {
      isAdmin: true,
    }
  },
  {
    path: '/create',
    name: 'create',
    component: () => import('../views/CreateView.vue')
  },
  {
    path: '/leave',
    name: 'all leave',
    component: () => import('../views/LeaveView.vue'),
    meta: {
      isAdmin: true,
    }
  }, 
  {
    path: '/leave/:id',
    name: 'leave user id',
    component: () => import('../views/LeaveView.vue'),
    meta: {
      id: 5
    }
  }, 
  {
    path: '/profile',
    name: 'profile',
    component: () => import('../components/Profiles/ProfilesComponent.vue'),
  },
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router