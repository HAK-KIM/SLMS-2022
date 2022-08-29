<template>
 <v-alert
    v-model="alert"
    density="comfortable"
    type="success"
    variant="tonal"
    closable
    border="start"
    class="mb-3"
  >
    Leave request have been <strong v-if="status==true">approved</strong> <strong v-else-if="status==false">rejected</strong> successfully.
  </v-alert>

  <v-table
    class="rounded mx-auto elevation-6"
  >
      <leave :items='items' :leaves='leaves' @update='update'/>
  </v-table>
</template>

<script>
import leave from './LeaveComponent.vue'
  export default {
    components: {
      leave,
    },
    props: ['leaves'],
    emits: ['update'],
    data() {
      return {
        items: ['Type Leave', 'From', 'To', 'Status', 'Reason', 'Duration', this.$route.meta.isAdmin?'Action':null],
        alert: false,
        status: false
      }
    },
    methods: {
      update(id, status) {
        this.$emit('update', id, status);
        this.alert = true;
        if (status) {
          this.status = true;
        } 
      }
    }
  }
</script>