<template>
  <v-app id="inspire">
        <v-navigation-drawer
      v-model="drawer"
    > 
      <Sidebar />
    </v-navigation-drawer>
    <v-app-bar>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>SLMS</v-toolbar-title>
      <Menubar />
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import Menubar from './components/Navigation/MenuComponent.vue';
import Sidebar from './components/Navigation/SideMenu.vue';
export default {
  components: {
    Menubar,
    Sidebar,
  },
  data: () => ({ 
    drawer: null ,
    statuses: [
      { title: 'All leaves', to: '/all'},
      { title: 'Accepted only', to:'/accepted'},
      { title: 'Rejected only', to:'/rejected'},
    ],
    type: [
      {title: 'Sick', to: '/sick'},
      {title: 'Go to home town', to: '/hometown'},
      {title: 'Family event', to: '/event'},
      {title: 'All', to: '/all'},
    ],
    menuItem: [
      { title: 'Check leaves', icon: 'mdi-bell', to:'/checkleave'},
      { title: 'New Request', icon: 'mdi-creation', to:'/create'},
      { title: 'Logout',icon: 'mdi-logout', to: '/logout' },
    ],
    userInfo: {image: "https://p.kindpng.com/picc/s/366-3666562_passerelles-numeriques-cambodia-hd-png-download.png", username: 'vibol khan'},
    right: null,  
  }),
  provide() {
    return {menuItem: this.menuItem, userInfo: this.userInfo, statuses: this.statuses, type: this.type,}
  }
}
</script>