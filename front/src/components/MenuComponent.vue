<template>
    <v-list
            class="d-flex align-center"
        >
            <v-list-item
                v-for="item in this.$route.meta.isAdmin ? adminMenu : studentMenu"
                :key="item.title"
                :to="item.to"
            >
            <v-list-item-content class="d-flex pa-3">
                <div class="d-flex">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                    <v-icon color="primary" class="ml-1">{{ item.icon }}</v-icon>
                </div>
            </v-list-item-content>
            </v-list-item>
            <v-list-item>
            <v-list-item-avatar class="pa-3">
                <router-link to="/profile">
                    <v-img class="rounded-circle" width="40" :src="userInfo.image"></v-img>
                </router-link>
            </v-list-item-avatar>  
            </v-list-item>
    </v-list> 
</template>
<script>

export default {
  data: () => ({
  }),
  inject: ['adminMenu', 'userInfo', 'studentMenu']
}
</script>
