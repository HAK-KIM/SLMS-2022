<template>
  <v-app>
    <v-app-bar>
      <v-toolbar-title style="padding: 10px;margin-left: 30px;"><img :src="logos" alt="" width="50" height="50"> </v-toolbar-title>
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
      { title: 'Home', icon: 'mdi-home', to:'/'},
      { title: 'Students', icon: 'mdi-account-group', to:'/checkleave'},
      { title: 'New Request', icon: 'mdi-creation', to:'/create'},
      { title: 'Logout',icon: 'mdi-logout', to: '/signup' },
    ],
    userInfo: {image: "https://p.kindpng.com/picc/s/366-3666562_passerelles-numeriques-cambodia-hd-png-download.png", username: 'vibol khan'},
    logos: 'https://i.pinimg.com/564x/05/cd/df/05cddf679e00c43a62c7f4a53856d775.jpg',
    isNotLogin: null,
  }),
  provide() {
    return {menuItem: this.menuItem, userInfo: this.userInfo, statuses: this.statuses, type: this.type,login:this.isNotLogin}
  },
  methods:{
  },
}
</script>