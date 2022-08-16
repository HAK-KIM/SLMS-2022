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
    classes: [
      { title: '2022 WEB A', to: '/2022a', icon: 'mdi-google-classroom' },
      { title: '2022 WEB B', to:'/2022b', icon: 'mdi-google-classroom' },
      { title: '2022 SNA', to:'/2022sna', icon: 'mdi-google-classroom' },
    ],
    menuItem: [
      { title: 'Check leaves', icon: 'mdi-check-circle-outline', to:'/checkleave'},
      { title: 'Logout',icon: 'mdi-logout', to: '/logout' },
    ],
    userInfo: {image: "https://p.kindpng.com/picc/s/366-3666562_passerelles-numeriques-cambodia-hd-png-download.png", username: 'vibol khan'},
    right: null,  
  }),
  provide() {
    return {menuItem: this.menuItem, userInfo: this.userInfo, classes: this.classes}
  }
}
</script>