<template>
  <v-row justify="space-around" align="center">
    <v-card width="150px">
      <v-img
        src="https://img.freepik.com/free-vector/expert-approved-cartoon-character-holding-checkmark-symbol-hand-finished-task-done-sign-satisfactory-official-sanction-acceptance_335657-829.jpg?w=2000">
      </v-img>
      <p style="color: green">Approved: {{ approved }}</p>
    </v-card>

    <v-card width="150px">
      <v-img src="https://blog.influenceandco.com/hubfs/Blog_Pictures/How-to-Handle-Sales-Rejection.png" height="150px">
      </v-img>
      <p style="color: red">Rejected: {{ rejected }}</p>
    </v-card>

    <v-card width="150px">
      <v-img
        src="https://media.istockphoto.com/vectors/attach-files-document-vector-id1093966834?k=20&m=1093966834&s=612x612&w=0&h=uZ41FITavbX07LlNHGFw-rrAv3lANKGv1yn6CFw3uWo=">
      </v-img>
      <p style="color: orange">New Request: {{ newRequest }}</p>
    </v-card>
  </v-row>
  <v-table class="rounded-lg mt-4" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
    <thead>
      <tr style="background-color: #04e">
        <th v-for:="item in items" class="text-left text-white font-weight-medium" style="font-size: 16px">
          {{ item }}
        </th>
      </tr>
      <v-dialog v-model="dialog" persistent hide-overlay transition="dialog-bottom-transition">
        <v-toolbar color="primary">
          <v-toolbar-title>Who is request?</v-toolbar-title>
          <v-icon @click="dialog = false" class="mr-4">mdi-close</v-icon>
        </v-toolbar>
        <v-list class="px-4">
          <studentInfo :student="student" elevation="6" />
        </v-list>
      </v-dialog>
    </thead>
    <tbody>
      <p v-if="leaves.length == 0" width="100%" class="text-center text-error text-h6 pa-5">
        No leave found
      </p>
      <tr v-for:="item in leaves" style="cursor:pointer;" class="py-2">
        <td @click="showDialog(item.id)" class="d-flex align-center font-weight-bold py-2" v-if="user !== 'student'">
          <img :src="item.user.image !=null ? item.user.image : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'"
            class="mr-3" />
          {{ item.user.firstName }} {{ item.user.lastName }}
        </td>
        <td @click="showDialog(item.id)">{{ item.leave_type }}</td>
        <td @click="showDialog(item.id)">
          <span v-if="item.status == true" class="text-primary">Approved</span>
          <span v-else-if="item.status == false" class="text-error">Rejected</span>
          <span v-else-if="item.status == null" class="text-warning">New</span>
        </td>
        <td @click="showDialog(item.id)" width="300px">{{ item.reason }}</td>
        <td @click="showDialog(item.id)">
          {{ item.duration }} <span v-if="item.duration > 1">Days</span><span v-else>Day</span>
        </td>
        <td v-if="
          item.status == null && this.$route.meta.isAdmin && !this.noAction
        " class="text-center pa-0">
          <v-actions @click="update(item.id, item.user.id, true)" style="background-color: #04e">
            <span>Approve</span>
          </v-actions>
          <v-actions @click="update(item.id, item.user.id, false)" style="background-color: #e04" class="ml-3">
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
      user: localStorage.getItem("user"),
    };
  },
  methods: {
    update(id, userID, status) {
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
          this.$emit("update", id, userID, status);
          if (status) {
            this.status = true;
            this.approved += 1;
            this.newRequest -= 1;
          } else {
            this.newRequest -= 1;
            this.rejected += 1;
          }
        }
      });
    },
    countApprovedAndRejected() {
      for (let status of this.leaves) {
        if (status.status == true) {
          this.approved += 1;
        } else if (status.status == null) {
          this.newRequest += 1;
        } else {
          this.rejected += 1;
        }
      }
    },
    showDialog(id) {
      if (localStorage.getItem('user')!=='student') {
        this.dialog = true;
        for (let leave of this.leaves) {
          if (id == leave.id) {
            this.student = leave.user;
          }
          console.log(leave.user);
        }
      }
    },
  },
  updated() {
    this.approved = 0;
    this.newRequest = 0;
    this.rejected = 0;
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
img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
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
