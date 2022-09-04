<template>
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
      if (status) {
        this.status = true;
      }
    },
  },
};
</script>
