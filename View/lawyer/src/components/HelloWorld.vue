<template>
  <form @submit.prevent="handleSubmit" >
      <label >First Name:</label>
      <input type="text" required v-model="Fname">

      <label >Last Name:</label>
      <input type="text" required v-model="Lname">

      <label >Email:</label>
      <input type="text" required v-model="Email">

      <button type="submit" class="submit">Join Us</button>
  </form>
  
  
</template>

<script>
export default {
    name: 'HelloWorld',
    data(){
        return {
            Fname: '',
            Lname: '',
            Email: '',
            result:{},
        }
    },
    methods:{
        async handleSubmit(){

        const data = {
            Fname: this.Fname,
            Lname: this.Lname,
            Email: this.Email,
            result: this.result,
        };
      console.log(data);
            fetch("http://localhost/Brief6/ApiUserController/createUser", {
            method: "POST",
            header: "Content-type: application/json",

            body: JSON.stringify(data),
            })
            .then (function(response) {
                return response.json();
            })
            .then (x => {
                console.log(x);
                alert("Please keep your token: " + x.Reference);
            })

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