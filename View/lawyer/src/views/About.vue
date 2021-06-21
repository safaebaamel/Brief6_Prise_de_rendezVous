<template>
  <div class="about">
    <img alt="Vue logo" src="../assets/lawyer.jpg">
    <Form msg="Hey Dear Client!"/>
  </div>
</template>

<script>
// @ is an alias to /src
import Form from '@/components/Form.vue'

export default {
  name: 'about',
  components: {
    Form
  }
}
</script>
<style scoped>
img {
  width: 300px;
  height: 500px;
}
</style>