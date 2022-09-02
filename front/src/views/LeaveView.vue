<template>
  <section class="d-flex justify-center mt-3 pa-0 mb-0">
    <v-col cols = "3" sm="3">
    <v-select
      class="text-white"
      :items = "batches"
      label = "Filter By Batches"
      variant = "outlined"
      v-model="studentBatches"
    ></v-select>
    </v-col>
    <v-col cols="3" sm="3">
      <v-select
        class="text-white"
        :items="items"
        label="Filter By Status"
        variant="outlined"
        v-model="filter"
      ></v-select>
    </v-col>
    <v-col cols="3" sm="3">
      <v-select
        class="text-white"
        :items="type"
        label="Filter By Leave Type"
        variant="outlined"
        v-model="leaveType"
      ></v-select>
    </v-col>
  </section>
  <section class="px-2 pb-3">
    <leaveTable :leaves='filterData' @update="updateRequest"  />
  </section>
</template>
<script>
import axios from '../axios-http.js'
import leaveTable from '@/components/TableLeaveComponent.vue';
export default ({
  data() {
    return {
      items: ['All', 'Check Approve Only', 'Check Rejected Only'],
      type: ['All', 'Go to Home Town', 'Sick', 'Family Event'],
      batches: ['2022', '2023'],
      studentsBatches: [],
      leaves: [],
      filter: 'All',
      leaveType: 'All',
      stuBatches: 'All'
    }
  },
  components: {
    leaveTable,
  },
  computed: {
    filterData() {
      let items = this.leaves;
      if (this.filter == "Check Approve Only") {
        items = this.getApprove();
      } if (this.filter == "Check Rejected Only"){
        items = this.getRejected();
      } if (this.leaveType == 'Go to Home Town') {
        items = this.getGoHomeType();
      } if (this.leaveType == 'Sick') {
        items = this.getSickType();
      } if (this.leaveType == 'Family Event') {
        items = this.getFamilyEventType();
      }
      return items;
    },
  },
  methods: {
    getData() {
      axios.get('requests')
      .then((response) => {
        this.leaves = response.data.reverse();
        console.log('requsts----------------'+response.data);
      })
    },
    getApprove() {
      let items = [];
      for (let leave of this.leaves) {
          if (leave.status == true) {
            items.unshift(leave);
          }
      }
      return items;
    },
    getRejected() {
      let items = [];
      for (let leave of this.leaves) {
          if (leave.status == false) {
            items.unshift(leave);
          }
      }
      return items;
    },
    getGoHomeType() {
      let items = [];
      for (let leave of this.leaves) {
          if (leave.leave_type == 'Go to home town') {
            items.unshift(leave);
          }
      }
      return items;
    },
    getSickType() {
      let items = [];
      for (let leave of this.leaves) {
          if (leave.leave_type == 'Sick') {
            items.unshift(leave);
          }
      }
      return items;
    },
    getFamilyEventType() {
      let items = [];
      for (let leave of this.leaves) {
          if (leave.leave_type == 'Family event') {
            items.unshift(leave);
          }
      }
      return items;
    },
    updateRequest(id, userID, status) {
      axios.put('requests/'+id, {status: status})
      .then((response)=> {
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
        body: status ? "Dear student, I hope you are doing well. I am writting this email to let you know you are allow to leave.": "Dear student, I hope you are doing well. I am writting this email to let you know you are not allow to leave.", 
        actiontext: 'Go to Website', 
        actionurl: 'http://localhost:8080/', 
        endtext: 'I am looking forward to heaing from you.'
      }
      axios.post('user/email/'+id, body)
        .then((response=> {{
          console.log(response.data);
      }}))
    },
    getLeaveById(id) {
      axios.get('students/'+id)
      .then((response=>{
        this.leaves = response.data.leaves;
        console.log(response.data.leaves);
      }))
    }
  },
  created() {
    if (localStorage.getItem('id')) {
      this.$router.push('/leave/' + localStorage.getItem('id'))
      if (!this.$route.meta.isAdmin) {
        this.getLeaveById(localStorage.getItem('id'));
      }
    }
    else if (this.$route.meta.isAdmin) {
      this.getData();
    }
  },
});
</script>