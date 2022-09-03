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
                        <v-icon class="text-left text-white">{{item.icon}}</v-icon>
                    </div>
                </v-list-item-content>
            </v-list-item>
            <!-- <v-list-item>
                <v-list-item-avatar class="pa-3">
                    <router-link to="/profile">
                        <v-img class="rounded-circle " width="40" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv4gEyPWM753daTs1eDDPEbJVqECmiMZRmLw&usqp=CAU"></v-img>
                    </router-link>
                </v-list-item-avatar>  
            </v-list-item> -->
    </v-list> 
</template>
<script>

export default {
  data: () => ({
  }),
  inject: ['adminMenu', 'userInfo', 'studentMenu']
}
</script>
