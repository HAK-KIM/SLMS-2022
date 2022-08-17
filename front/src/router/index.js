import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('../views/SocialOffairView.vue')

  },
  {
    path: '/all',
    name: 'all',
    component: () => import('../views/StudentLeaveView.vue')
  },
  {
    path: '/accepted',
    name: 'accepted',
    component: () => import('../views/AcceptedLeaveView.vue')
  },
  {
    path: '/rejected',
    name: 'rejected',
    component: () => import('../views/RejectedLeaveView.vue')
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
  {
    path: '/sick',
    name: 'sick',
    component: () => import('../views/SickTypeView.vue')
  }, 
  {
    path: '/hometown',
    name: 'hometown',
    component: () => import('../views/GoToHomeTownView.vue')
  }, 
  {
    path: '/event',
    name: 'event',
    component: () => import('../views/EventLeaveView.vue')
  }, 
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router