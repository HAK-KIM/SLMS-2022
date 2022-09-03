<template>
  <section>
      <FormLeave />
  </section>
</template>

<script>
import FormLeave from '../components/FormLeave.vue';

export default ({
  components: {
    FormLeave,
  },
  data: () => ({
    leaves: [],
  }),
});
</script>