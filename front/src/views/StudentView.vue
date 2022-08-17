<template>
  <section class="d-flex justify-center pa-6">
    <FormView @leave="createLeave" />
  </section>
</template>

<script>

// Components
import axios from 'axios';
import FormView from '../components/FormView.vue';

export default ({
  components: {
    FormView,
  },
  data: () => ({
    leaves: [],
    url: "http://127.0.0.1:8000/api/requests",
    successed: false
  }),
  methods: {
    createLeave(item) {
      this.leaves.push(item);
      axios.post(this.url, item)
      .then((response) => {
        console.log(response.data);
      })
    }
  }

});
</script>