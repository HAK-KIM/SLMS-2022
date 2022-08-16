<template>
  <div class="student">
    <h1>This is students  pages</h1>
    <form-view/>
  </div>
</template>
<script>
import Form from "../components/FormView.vue"
export default ({
  components:{
'form-view':Form
  }
})
</script>