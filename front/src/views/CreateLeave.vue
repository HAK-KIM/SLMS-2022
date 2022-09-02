<template>
  <section>
      <FormLeave />
  </section>
  <section >
    <v-overlay v-model="overlay" class="d-flex justify-center align-center">
      <v-progress-circular
        indeterminate
        size="100"
      >Loading</v-progress-circular>
    </v-overlay>
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
    overlay: false,
  }),
  watch: {
    overlay (val) {
      val && setTimeout(() => {
        this.overlay = false;
      }, 300)
    },
  },
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
  created() {
    this.overlay = true;
  }
});
</script>