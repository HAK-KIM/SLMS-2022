<template>
  <v-table>
    <thead>
      <tr>
        <th>
          <p style="color: green">Approved: {{ approved }}</p>
        </th>
        <th>
          <p style="color: red">Rejected: {{ rejected }}</p>
        </th>
        <th>
          <p style="color: orange">New Request: {{ newRequest }}</p>
        </th>
      </tr>
      <tr style="background-color: #04e">
        <th
          v-for:="item in items"
          class="text-left text-white font-weight-medium"
          style="font-size: 16px"
        >
          {{ item }}
        </th>
      </tr>
      <v-dialog
        v-model="dialog"
        persistent
        hide-overlay
        transition="dialog-bottom-transition"
      >
        <v-toolbar color="primary">
          <v-toolbar-title>Student Detail</v-toolbar-title>
          <v-icon @click="dialog = false" class="mr-4">mdi-close</v-icon>
        </v-toolbar>
        <v-list class="px-4">
          <studentInfo :student="student" elevation="6" />
        </v-list>
      </v-dialog>
    </thead>
    <tbody>
      <p
        v-if="leaves.length == 0"
        width="100%"
        class="text-center text-error text-h6 pa-5"
      >
        No leave found
      </p>
      <tr v-for:="item in leaves">
        <td @click="showDialog(item.id)">{{ item.leave_type }}</td>
        <td>{{ item.date_start }}</td>
        <td>{{ item.end_date }}</td>
        <td>
          <span v-if="item.status == true" class="text-primary">Approved</span>
          <span v-else-if="item.status == false" class="text-error"
            >Rejected</span
          >
          <span v-else-if="item.status == null" class="text-warning">New</span>
        </td>
        <td width="300px">{{ item.reason }}</td>
        <td>
          {{ item.duration }} <span v-if="item.duration > 1">Days</span
          ><span v-else>Day</span>
        </td>
        <td
          v-if="
            item.status == null && this.$route.meta.isAdmin && !this.noAction
          "
          class="text-center pa-0"
        >
          <v-actions
            @click="update(item.id, true)"
            style="background-color: #04e"
          >
            <span>Approve</span>
          </v-actions>
          <v-actions
            @click="update(item.id, false)"
            style="background-color: #e04"
            class="ml-3"
          >
            <span>Reject</span>
          </v-actions>
        </td>
      </tr>
    </tbody>
  </v-table>
</template>

<script>
import Swal from "sweetalert2";
import studentInfo from "./StudentInformation.vue";
export default {
  components: {
    studentInfo,
  },
  props: ["items", "leaves", "noAction"],
  emits: ["update"],
  data() {
    return {
      approved: 0,
      rejected: 0,
      newRequest: 0,
      dialog: false,
      student: {},
    };
  },
  methods: {
    update(id, status) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: status ? "Yes, I approve" : "Yes, I reject",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$emit("update", id, status);
          this.alert = true;
          if (status) {
            this.status = true;
            this.approved += 1;
            this.newRequest += 1;
          } else {
            this.rejected += 1;
          }
        }
      });
    },
    countApprovedAndRejected() {
      for (let status of this.leaves) {
        if (status.status == 1) {
          this.approved += 1;
        } else if (status.status == null) {
          this.newRequest += 1;
        } else {
          this.rejected += 1;
        }
      }
    },
    showDialog(id) {
      this.dialog = true;
      for (let leave of this.leaves) {
        if (id == leave.id) {
          this.student = leave.user;
        }
        console.log(leave.user);
      }
    },
  },
  updated() {
    this.countApprovedAndRejected();
  },
};
</script>

<style scoped>
td:nth-of-type(even) {
  background-color: rgba(0, 0, 0, 0.13);
}
v-actions {
  cursor: pointer;
  padding: 5px 15px;
  border-radius: 10px;
  color: #fff;
}
p {
  text-align: center;
  padding: 2%;
}
</style>
