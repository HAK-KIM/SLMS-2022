<template>
  <v-app>
    <v-app-bar v-if="!$route.meta.hideNavbar" style="background-color: #04e">
      <v-toolbar-title class="mt-2" style="margin-left: 30px">
        <img :src="logos" alt="" width="130" height="130" />
      </v-toolbar-title>
      <Menubar :imageProfile="users.image"/>
    </v-app-bar>
    <div class="area">
      <v-main>
        <router-view />
      </v-main>
      <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
  </v-app>
</template>

<script>
import axios from './axios-http';
import Menubar from "./components/MenuComponent.vue";
export default {
  components: {
    Menubar,
  },
  data: () => ({
    adminMenu: [
      { title: "List Leaves", icon: "mdi-home", to: "/leave" },
      { title: "Students", icon: "mdi-account-group", to: "/students" },
      { title: "Logout", icon: "mdi-logout", to: "/" },
      { title: "", icon: "mdi-account-tie", to: "/profile-admin" },
    ],
    studentMenu: [
      {
        title: "My Leaves",
        icon: "mdi-home",
        to: "/leave/" + localStorage.getItem("id"),
      },
      { title: "New Request", icon: "mdi-creation", to: "/create" },
      { title: "Logout", icon: "mdi-logout", to: "/" },
    ],
    EXPIRE_TIME: 1000 * 60 * 60,
    users: {},
    logos:"https://i.pinimg.com/236x/e5/c3/36/e5c3363701f1a2d7f29fba6ed0ccb97d.jpg",
  }),
  methods: {
    clearLocalstorage() {
      setTimeout(function () {
        localStorage.removeItem("Authorization");
      }, this.EXPIRE_TIME);
    },
    getImageProfile() {
      axios.get('/students/'+ localStorage.getItem("id"))
      .then((response)=>{
          this.users = response.data
      })
    }
  },
 
  mounted() {
      return this.getImageProfile();
  },
  provide() {
    return {
      adminMenu: this.adminMenu,
      studentMenu: this.studentMenu,
      userInfo: this.userInfo,
      statuses: this.statuses,
      type: this.type,
      login: this.isNotLogin,
    };
  },
};
</script>
<style>

* {
  margin: 0px;
  padding: 0px;
}

body {
  font-family: "Exo", sans-serif;
}

.area {
  background: #bfbfc0;
  width: 100%;
  height: 100%;
}

.circles {
  position: static;
  top: 0;
  left: 0;
  width: 100%;
  height: 0%;
  overflow: hidden;
}

.circles li {
  position: absolute;
  display: block;
  list-style: none;
  width: 20px;
  height: 20px;
  background: rgba(255, 255, 255, 0.2);
  animation: animate 25s linear infinite;
  bottom: 0px;
}

.circles li:nth-child(1) {
  left: 25%;
  width: 80px;
  height: 80px;
  animation-delay: 0s;
}

.circles li:nth-child(2) {
  left: 10%;
  width: 20px;
  height: 20px;
  animation-delay: 2s;
  animation-duration: 12s;
}

.circles li:nth-child(3) {
  left: 70%;
  width: 20px;
  height: 20px;
  animation-delay: 4s;
}

.circles li:nth-child(4) {
  left: 40%;
  width: 60px;
  height: 60px;
  animation-delay: 0s;
  animation-duration: 18s;
}

.circles li:nth-child(5) {
  left: 65%;
  width: 20px;
  height: 20px;
  animation-delay: 0s;
}

.circles li:nth-child(6) {
  left: 75%;
  width: 110px;
  height: 110px;
  animation-delay: 3s;
}

.circles li:nth-child(7) {
  left: 35%;
  width: 150px;
  height: 150px;
  animation-delay: 7s;
}

.circles li:nth-child(8) {
  left: 50%;
  width: 25px;
  height: 25px;
  animation-delay: 15s;
  animation-duration: 45s;
}

.circles li:nth-child(9) {
  left: 20%;
  width: 15px;
  height: 15px;
  animation-delay: 2s;
  animation-duration: 35s;
}

.circles li:nth-child(10) {
  left: 85%;
  width: 150px;
  height: 150px;
  animation-delay: 0s;
  animation-duration: 11s;
}

@keyframes animate {
  0% {
    transform: translateY(0) rotate(0deg);
    opacity: 1;
    border-radius: 0;
  }

  100% {
    transform: translateY(-1000px) rotate(720deg);
    opacity: 0;
    border-radius: 50%;
  }
}
</style>