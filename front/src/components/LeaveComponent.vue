<template>
  <v-row justify="space-around" align="center">
    <v-card width="150px">
      <v-img src="https://img.freepik.com/free-vector/expert-approved-cartoon-character-holding-checkmark-symbol-hand-finished-task-done-sign-satisfactory-official-sanction-acceptance_335657-829.jpg?w=2000"></v-img>
      <p style="color: green">Approved: {{ approved }}</p>
    </v-card>

    <v-card width="150px">
      <v-img src="https://blog.influenceandco.com/hubfs/Blog_Pictures/How-to-Handle-Sales-Rejection.png" height="150px"></v-img>
      <p style="color: red">Rejected: {{ rejected }}</p>
    </v-card>

    <v-card width="150px">
      <v-img src="https://media.istockphoto.com/vectors/attach-files-document-vector-id1093966834?k=20&m=1093966834&s=612x612&w=0&h=uZ41FITavbX07LlNHGFw-rrAv3lANKGv1yn6CFw3uWo="></v-img>
      <p style="color: orange">New Request: {{ newRequest }}</p>
    </v-card>
  </v-row>
  <v-table class="rounded-lg mt-4" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
    <thead>
      <tr style="background-color: #04e">
        <th
          v-for:="item in items"
          class="text-left text-white font-weight-medium"
          style="font-size: 16px"
        >
          {{ item }}
        </th>
      </tr>
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
        <td
          class="d-flex align-center font-weight-bold"
          v-if="user !== 'student'"
        >
          <img
            src="https://i.zoomtventertainment.com/story/Jungkook_13.png"
            alt=""
            class="mr-3"
          />
          {{ item.user.firstName }} {{ item.user.lastName }}
        </td>
        <td>{{ item.leave_type }}</td>
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
            @click="update(item.id, item.user.id, true)"
            style="background-color: #04e"
          >
            <span>Approve</span>
          </v-actions>
          <v-actions
            @click="update(item.id, item.user.id, false)"
            style="background-color: #e04"
            class="ml-3"
          >
            <span>Reject</span>
          </v-actions>
        </td>
        <td v-else></td>
      </tr>
    </tbody>
  </v-table>
</template>

<script>
import Swal from "sweetalert2";
export default {
  props: ["items", "leaves", "noAction"],
  emits: ["update"],
  data() {
    return {
      approved: 0,
      rejected: 0,
      newRequest: 0,
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
          this.alert = true;
          if (status) {
            this.status = true;
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
  },
  updated() {
    this.countApprovedAndRejected();
  },
  created() {
    console.log(
      this.user ==
        "student" +
          "==============================================================="
    );
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
