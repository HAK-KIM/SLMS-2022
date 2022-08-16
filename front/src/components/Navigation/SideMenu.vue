<template>
  <v-list-item>
    <v-list-item-content>
      <v-list-item-title class="text-h6">
        Class list
      </v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <v-list
    dense
    nav
  >
    <v-list-item
      v-for="classMenu in classes"
      :key="classMenu.title"
      :to="classMenu.to"
    >
      <v-list-item-content class="d-flex align-center">
        <v-icon color="primary" class="mr-3">{{classMenu.icon}}</v-icon>
        <v-list-item-title>{{ classMenu.title }}</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
  </v-list>
</template>

<script>
    export default {
        inject: ['classes']
    }
</script>