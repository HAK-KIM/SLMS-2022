<template>
    <v-list 
            class="d-flex align-center "
            style="background-color: #04e"
            
        >
            <v-list-item
                v-for="item in this.$route.meta.isAdmin ? adminMenu : studentMenu"
                :key="item.title"
                :to="item.to"
            >

                <v-list-item-content class="d-flex pa-4">
                    <div class="d-flex">
                        <v-list-item-title class="text-left text-white text-uppercase">{{ item.title }}</v-list-item-title>
                        <v-icon color="white" class="ml-1" v-if="item.icon">{{ item.icon }}</v-icon>
                    </div>
                </v-list-item-content>
            </v-list-item>
          
        </v-list> 
        <div class="image" style="width:10%;text-align:center;">
            <router-link :to="user=='student' ? '/profile-user' : '/profile-admin'">
                <img :src="imageProfile !=null?imageProfile:avataImage" alt="" width="40" height="40" style="border-radius:50%;">
            </router-link>
        </div>
</template>
<script>
export default {
    props:['imageProfile'],
  data: () => ({
    avataImage:'https://cdn-icons-png.flaticon.com/512/149/149071.png',
    user: localStorage.getItem('user'),
  }),
  inject: ['adminMenu', 'studentMenu',],
  
}
</script>
 