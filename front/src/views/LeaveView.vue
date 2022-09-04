<template>
  <section class="d-flex justify-center mt-3 pa-0 mb-0">
    <v-col cols="3" sm="3" v-if="user == 'teacher'">
      <v-select class="text-white" :items="['All', '2022', '2023']" label="Filter By Batches" variant="outlined" v-model="stuBatches">
      </v-select>
    </v-col>
    <v-col cols="3" sm="3">
      <v-select class="text-white" :items="['All', 'New Request Only', 'Check Approved Only', 'Check Rejected Only']"
        label="Filter By Status" variant="outlined" v-model="status">
      </v-select>
    </v-col>
    <v-col cols="3" sm="3">
      <v-select class="text-white" :items="['All', 'Go to home town', 'Sick', 'family event']"
        label="Filter By Leave Type" variant="outlined" v-model="leaveType">
      </v-select>
    </v-col>
  </section>
  <section>
    <v-overlay v-model="overlay" class="d-flex justify-center align-center">
      <v-progress-circular indeterminate size="100">Loading</v-progress-circular>
    </v-overlay>
  </section>
  <section class="px-2 pb-3">
    <leaveTable :leaves='filterData' @update="updateRequest" />
  </section>
</template>
<script>
import axios from '../axios-http'
import leaveTable from '@/components/TableLeaveComponent.vue';
export default ({
  data() {
    return {
      leaves: [],
      status: 'All',
      leaveType: 'All',
      stuBatches: 'All',
      overlay: false,
      user: ''
    }
  },
  components: {
    leaveTable,
  },
  computed: {
    filterData() {
      let items = this.leaves;
      if (this.status == "New Request Only") {
        items = this.leaves.filter(leave => (leave.status == null));
      } if (this.status == "Check Approved Only") {
        items = this.leaves.filter(leave => (leave.status == true));
      } if (this.status == "Check Rejected Only") {
        items = this.leaves.filter(leave => (leave.status == false));
      } if (this.leaveType != "All") {
        items = items = this.leaves.filter(leave => (leave.leave_type == this.leaveType));
      } if (this.stuBatches != "All") {
        items = items = this.leaves.filter(leave => (leave.user.batch == this.stuBatches));
      }
      return items;
    },
  },
  methods: {
    getData() {
      axios.get('requests')
        .then((response) => {
          this.leaves = response.data;
          console.log('requsts----------------' + response.data);
          this.overlay = false;
        })
    },
    updateRequest(id, userID, status) {
      axios.put('requests/' + id, { status: status })
        .then((response) => {
          for (let leave of this.leaves) {
            if (leave.id == id) {
              leave.status = status;
              this.sentMailToStudent(userID, status);
            }
          }
          console.log(response.data);
        })
    },
    sentMailToStudent(id, status) {
      let body = {
        greeting: status ? 'Approve for leave request' : 'Reject for leave request',
        body: status ? "Dear student, I hope you are doing well. I am writting this email to let you know you are allow to leave." : "Dear student, I hope you are doing well. I am writting this email to let you know you are not allow to leave.",
        actiontext: 'Go to Website',
        actionurl: 'http://localhost:8080/',
        endtext: 'I am looking forward to heaing from you.'
      }
      axios.post('user/email/' + id, body)
        .then((response => {
          {
            console.log(response.data);
          }
        }))
    },
    getLeaveById(id) {
      axios.get('students/' + id)
        .then((response => {
          this.leaves = response.data.leaves;
          console.log(response.data.leaves);
          this.overlay = false;
        }))
    }
  },
  created() {
    this.overlay = true;
    if (localStorage.getItem('user') && localStorage.getItem('Authorization')) {
      this.user = localStorage.getItem('user');
      if (localStorage.getItem('id') && !this.$route.meta.isAdmin) {
        this.$router.push('/leave/' + localStorage.getItem('id'))
        this.getLeaveById(localStorage.getItem('id'));
        console.log('i am student')
      }
      else if (this.$route.meta.isAdmin) {
        this.getData();
        console.log('i am admin')
      }
    } else {
      console.log('No one here')
    }
  },
});
</script>