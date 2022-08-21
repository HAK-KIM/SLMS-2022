<template>
  <section class="px-3 mt-3">
    <v-table
      class="rounded mx-auto"
      style="width: 900px; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;"
    >
      <thead>
        <tr style="background-color: #04e;">
          <th v-for:="item in items" class="text-left text-h6 text-white">{{item}}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for:="item in users">
          <td >{{ item.name }}</td>
          <td>{{ item.email }}</td>
          <td>
            <router-link :to="'/create/'+item.id" class="text-decoration-none"><FormView /></router-link>
          </td>
        </tr>
      </tbody>
    </v-table>
  </section>
</template>

<script>

// Components
import axios from '../axios-http';
import FormView from '../components/FormView.vue';

export default ({
  components: {
    FormView,
  },
  data: () => ({
    leaves: [],
    successed: false,
    items: ['Username', 'Email', 'Request To'],
    users: []
  }),
  methods: {
    createLeave(item) {
      this.leaves.push(item);
      axios.post(this.url, item)
      .then((response) => {
        console.log(response.data);
        axios.post('user/email'+this.$route.parms.userId)
      })
    },
    getData() {
      axios.get('users')
      .then((response) => {
        this.users = response.data
      })
    }
  },
  mounted() {
    this.getData();
  }

});
</script>