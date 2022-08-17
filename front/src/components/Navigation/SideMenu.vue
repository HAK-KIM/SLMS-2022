<template>
  <v-list-item>
    <v-list-item-content>
      <v-list-item-title class="text-h6">
        Filter By Status
      </v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <v-menu>
    <template v-slot:activator="{ props }">
      <div
        v-bind="props"
        width="100%"
        class="pa-4 text-left"
        style="cursor:pointer;"
      >
        Filter By Status
        <v-icon>{{'mdi-chevron-down'}}</v-icon>
      </div>
    </template>

    <v-list>
      <v-list-item
        v-for="(item, index) in statuses"
        :key="index"
        :to="item.to"
      >
        <v-list-item-title>{{ item.title }}</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
  <v-menu>
    <template v-slot:activator="{ props }">
      <div
        v-bind="props"
        width="100%"
        class="pa-4 text-left"
        style="cursor:pointer;"
      >
        <v-list-item-content>
          Filter By Type leaves
          <v-icon>{{'mdi-chevron-down'}}</v-icon>
        </v-list-item-content>
      </div>
    </template>

    <v-list>
      <v-list-item
        v-for="(item, index) in type"
        :key="index"
        :to="item.to"
      >
        <v-list-item-title>{{ item.title }}</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
  export default {
    inject: ['statuses', 'type'],
  }
</script>