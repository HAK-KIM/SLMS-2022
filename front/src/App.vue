<template>
  <v-app>
    <v-app-bar>
      <v-toolbar-title> SLMS </v-toolbar-title>
      <Menubar />
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import Menubar from './components/Navigation/MenuComponent.vue';
export default {
  components: {
    Menubar,
  },
  data: () => ({ 
    menuItem: [
      { title: 'List Leaves', icon: 'mdi-home', to:'/'},
      { title: 'Students', icon: 'mdi-account-group', to:'/checkleave'},
      { title: 'New Request', icon: 'mdi-creation', to:'/create'},
      { title: 'Logout',icon: 'mdi-logout', to: '/logout' },
    ],
    userInfo: {image: "https://thumbs.dreamstime.com/b/cute-cat-portrait-square-photo-beautiful-white-closeup-105311158.jpg", username: 'vibol khan'},
  }),
  provide() {
    return {menuItem: this.menuItem, userInfo: this.userInfo, statuses: this.statuses, type: this.type,}
  }
}
</script>