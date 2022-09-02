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
                        <!-- <v-img v-else class="rounded-circle " width="40" :src="image"></v-img> -->
                    </div>
                </v-list-item-content>
            </v-list-item>
    </v-list> 
</template>
<script>

export default {
  data: () => ({
    image:'https://cdn-icons-png.flaticon.com/512/149/149071.png'
  }),
  inject: ['adminMenu', 'userInfo', 'studentMenu']
}
</script>
