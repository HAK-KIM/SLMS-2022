<template>
  <v-app>
    <v-app-bar v-if="!$route.meta.hideNavbar " 
    style="background-color: #04e"
    >
      <v-toolbar-title class="mt-2" style=" margin-left:30px;"><img :src="logos" alt="" width="130" height="130"> </v-toolbar-title>
      <Menubar :imageProfile="users.image"/>
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import axios from './axios-http';
import Menubar from './components/MenuComponent.vue';
export default {
  components: {
    Menubar,
  },
  data: () => ({ 
    adminMenu: [
      { title: 'List Leaves', icon: 'mdi-home', to:'/leave'},
      { title: 'Students', icon: 'mdi-account-group', to:'/students'},
      { title: 'Logout',icon: 'mdi-logout', to: '/' },
      { title: 'admin',icon: 'mdi-account-tie', to: '/profile-admin' },
    ],
    studentMenu: [
      { title: 'My Leaves', icon: 'mdi-home', to:'/leave/'+localStorage.getItem('id')},
      { title: 'New Request', icon: 'mdi-creation', to:'/create'},
      { title: 'Logout',icon: 'mdi-logout', to: '/' },
      // { title: 'user',icon: '', to: '/profile-user' },
    ],  
    EXPIRE_TIME: 1000*60*60,

    logos: 'https://i.pinimg.com/236x/e5/c3/36/e5c3363701f1a2d7f29fba6ed0ccb97d.jpg',
    users:{}
  }), 
  methods: {
    clearLocalstorage() {
      setTimeout(function() {
        localStorage.removeItem('Authorization');
      }, this.EXPIRE_TIME);
    },
    getImageProfile() {
      axios.get('/students/'+ localStorage.getItem("id"))
      .then((response)=>{
          this.users = response.data
      })
    }
  },
  provide() {
    return {adminMenu: this.adminMenu, studentMenu: this.studentMenu, statuses: this.statuses, type: this.type,login:this.isNotLogin }
  },
  mounted() {
      return this.getImageProfile();
  }
}
</script>