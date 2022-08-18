<template>
  <section class="d-flex justify-center mt-6">
    <v-col
      cols="6"
      sm="3"
    >
      <v-select
        :items="items"
        label="Filter By Status"
        variant="outlined"
        v-model="filter"
      ></v-select>
    </v-col>
    <v-col
      cols="6"
      sm="3"
    >
      <v-select
        :items="type"
        label="Filter By Leave Type"
        variant="outlined"
        v-model="filter"
      ></v-select>
    </v-col>
  </section>
  <section>
    <card v-for="leave in filterData" :key="leave" :leave='leave'/>
  </section>
</template>

<script>
import axios from '../axios-http.js'
import card from '@/components/CardComponent.vue';
export default ({
  data() {
    return {
      items: ['All', 'Check Accepted Only', 'Check Rejected Only'],
      type: ['All', 'Go to Home Town', 'Sick', 'Family Event'],
      leaves: [],
      filter: 'All',
    }
  },
  components: {
    card
  },
  mounted() {
    this.getData();
  },
  computed: {
    filterData() {
      let items = this.leaves;
      if (this.filter == "Check Accepted Only") {
        items = this.getAccepted();
      } else if (this.filter == "Check Rejected Only"){
        items = this.getRejected();
      } else if (this.filter == 'Go to Home Town') {
        items = this.getGoHomeType();
      } else if (this.filter == 'Sick') {
        items = this.getSickType();
      } else if (this.filter == 'Family Event') {
        items = this.getFamilyEventType();
      }
      return items;
    },
  },
  methods: {
    getData() {
      axios.get('requests')
      .then((response) => {
        this.leaves = response.data;
      })
    },
    getAccepted() {
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
          if (leave.leave_type == 'family event') {
            items.unshift(leave);
          }
      }
      return items;
    }
  }
});
</script>