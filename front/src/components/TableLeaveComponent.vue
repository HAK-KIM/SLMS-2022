<template>
  <v-alert
    v-model="alert"
    density="comfortable"
    type="success"
    variant="tonal"
    color="white"
    closable
    border="start"
    class="mb-3"
  >
    Leave request have been <strong v-if="status == true">approved</strong>
    <strong v-else-if="status == false">rejected</strong> successfully.
  </v-alert>
  <leave
    elevation="6"
    :items="user == 'teacher' ? headerTeacher : headerStudent"
    :leaves="leaves"
    @update="update"
  />
</template>

<script>
import leave from "./LeaveComponent.vue";
export default {
  components: {
    leave,
  },
  props: ["leaves"],
  emits: ["update"],
  data() {
    return {
      alert: false,
      status: false,
      student: {},
      headerStudent: ["Type Leave", "Status", "Reason", "Duration"],
      headerTeacher: [
        "Username",
        "Type Leave",
        "Status",
        "Reason",
        "Duration",
        "actions",
      ],
      user: localStorage.getItem('user'),
    };
  },
  methods: {
    update(id, userID, status) {
      this.$emit("update", id, userID, status);
      this.alert = true;
      if (status) {
        this.status = true;
      }
    },
  },
};
</script>
