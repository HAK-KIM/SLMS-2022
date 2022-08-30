<template>
  <v-app>
    <v-app-bar v-if="!$route.meta.hideNavbar">
      <v-toolbar-title style="padding: 10px;margin-left: 30px;"><img :src="logos" alt="" width="50" height="50"> </v-toolbar-title>
      <Menubar />
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
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
    ],
    studentMenu: [
      { title: 'My Leaves', icon: 'mdi-home', to:'/leave/'+localStorage.getItem('id')},
      { title: 'New Request', icon: 'mdi-creation', to:'/create'},
      { title: 'Logout',icon: 'mdi-logout', to: '/' },
    ],  

    userInfo: {},
    logos: 'https://i.pinimg.com/564x/05/cd/df/05cddf679e00c43a62c7f4a53856d775.jpg',
  }), 
  methods: {

  },
  provide() {
    return {adminMenu: this.adminMenu, studentMenu: this.studentMenu, userInfo: this.userInfo, statuses: this.statuses, type: this.type,login:this.isNotLogin}
  },
}
</script>