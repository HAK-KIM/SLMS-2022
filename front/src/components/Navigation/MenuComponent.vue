<template>
    <v-list
            class="d-flex align-center"
        >
            <v-list-item
            v-for="item in menuItem"
            :key="item.title"
            :to="item.to"
            >
            <v-list-item-content class="d-flex pa-3">
                <v-badge
                    color="primary"
                    :content="menuItem.length"
                    v-if="item.title=='Check leaves'"
                >
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                    <v-icon color="primary" class="ml-1">{{ item.icon }}</v-icon>
                </v-badge>
                <div v-else class="d-flex">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                    <v-icon color="primary" class="ml-1">{{ item.icon }}</v-icon>
                </div>
            </v-list-item-content>
            </v-list-item>
            <v-list-item>
            <v-list-item-avatar class="pa-3">
                <v-img class="rounded-circle" width="60" :src="userInfo.image"></v-img>
            </v-list-item-avatar>  
            </v-list-item>
    </v-list> 
</template>
<script>

export default {
  data: () => ({
  }),
  inject: ['menuItem', 'userInfo']
}
</script>
