import { createRouter, createWebHistory } from 'vue-router'
import AddminView from '../views/AddminView.vue'
import StudentView from '../views/StudentView.vue'

const routes = [{
        path: '/',
        name: 'addmin',
        component: AddminView
    },
    {
        path: '/student',
        name: 'student',
        component: StudentView


    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router