<template>
  <v-rows class="d-flex justify-center  ">
    <v-col cols="4" class="d-flex justify-center flex-column align-center" v-if="progress">
      Loading
      <v-progress-linear
        rounded
        indeterminate
        color="#04e"
      ></v-progress-linear>
    </v-col>
  </v-rows>
  <section class="px-3 mt-3">
      <FormLeave/>
  </section>
</template>

<script>
import axios from '../axios-http';
import FormLeave from '../components/FormLeave.vue';

export default ({
  components: {
    FormLeave,
  },
  data: () => ({
    progress: false,
    leaves: [],
    successed: false,
  }),
  methods: {
    createLeave(item) {
      this.leaves.push(item);
      axios.post('requests', item)
      .then((response) => {
        console.log(response.data);
        
        axios.post('admin/email')
      })
    },
    emitProgress(status) {
      this.progress = status;
    }
  },
});
</script>
