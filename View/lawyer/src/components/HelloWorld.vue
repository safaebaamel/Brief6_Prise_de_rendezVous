<template>
  <form @submit.prevent="handleSubmit">
      <label >First Name:</label>
      <input type="text" required v-model="firstName">

      <label >Last Name:</label>
      <input type="text" required v-model="lastName">

      <label >Email:</label>
      <input type="text" required v-model="email">
      
      <div class="submit">
          <button>Join Us</button>
      </div>
  </form>
  
  
</template>

<script>
export default {
    name: 'firstFormulaire',
    data() {
        return {
            firstName: '',
            lastName: '',
            email: ''
        }
    },
    methods: {
    handleSubmit() {
        console.log('form submitted')
    }
    }

}
</script>

<style>
form{
    max-width: 420px;
    margin: 30px auto;
    background: rgba(221, 245, 255, 0.541);
    text-align: left;
    padding: 40px;
    border-radius: 10px;
}
label{
    color: rgb(0, 0, 0);
    display: inline-block;
    margin: 25px 0 15px;
    font-size: 0.6em;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: bold;
}
input{
    display: block;
    padding: 10px 6px;
    width: 100%;
    box-sizing: border-box;
    border: none;
    border-bottom: 1px solid #ddd;
    color: #555;
}
button {
    background: rgb(86, 85, 170);
    border: 0;
    padding:10px 20px;
    margin-top: 20px;
    color: white;
    border-radius: 20px;
}
.submit {
    text-align: center;
}


</style>