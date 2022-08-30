import { createRouter, createWebHistory } from 'vue-router'

// const isUserLoggedin = false;

const routes = [

  {
    path:"/",
    redirect:"/login"
  },

  {
    path: '/pageNotFound',
    component: () => import('../views/pageNotFound.vue'),
    meta: {
      hideNavbar: true,
    },
  },

  {
    path: "/:pathMatch(.*)*",
    component: () => import('../views/pageNotFound.vue'),
    meta: {
      hideNavbar: true,
    },
  },

  {
    path: '/login',
    name: 'login',
    component: () => import('../views/LoginView.vue'),
    meta: {
      hideNavbar: true,
      logout: true,
      Auth: false
    },
   
  },
  {
    path: '/adminlogin',
    name: 'loginAdmin',
    component: () => import('../views/LoginView.vue'),
    meta: {
      hideNavbar: true,
      isAdmin: true,
      Auth: false
    },
   
  },
  {
    path: '/students',
    name: 'students',
    component: () => import('../views/StudentView.vue'),
    meta: {
      isAdmin: true,
      Auth: true,
      user:'teacher'
      
    }
  },
  {
    path: '/leave',
    name: 'all leave',
    component: () => import('../views/LeaveView.vue'),
    meta: {
      isAdmin: true,
      Auth: true,
      user:'teacher'
      
    }
  }, 
  {
    path: '/create',
    name: 'create',
    component: () => import('../views/CreateView.vue'),
    meta: {
      Auth: true,
      user:'student'
      
      
    }
  },
  
  {
    path: '/leave/:id',
    name: 'leave user id',
    component: () => import('../views/LeaveView.vue'),
    meta: {
      Auth: true,
      user:'student'
      
    }
  }, 
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});




router.beforeEach((to, from, next) => {
  let userLogin = localStorage.getItem('user')
  if (to.meta.Auth) {
    if (!localStorage.getItem("Authorization") ) {
      next("/login");
    } else if (to.meta.user == userLogin) {
      next();
    // } else if (to.path =="/pageNotFound" ){
    } else if (to.path =="/reset_password" || to.path == "/home"){
      next();
    }
    else{
      next('/pageNotFound')
    }
  } 
  else {
    next();
  }
});



export default router