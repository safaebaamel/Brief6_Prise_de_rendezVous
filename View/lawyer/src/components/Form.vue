<template>
  <form @submit.prevent="handleSubmit">
      <label>Insert Your Reference</label>
      <input type="text" required v-model="reference">

      <div class="submit">
          <button>Submit</button>
      </div>
  </form>
  
  
</template>

<script>
export default {
    name: 'firstFormulaire',
    data() {
        return {
            Reference: '',
        }
    },
    methods:{
        async handleSubmit(){

        const data = {
            Reference: this.Reference,
        };
      console.log(data);
        fetch("http://localhost/Brief6/ApiUserController/", {
        method: "POST",
        header: "Content-type: application/json",

        body: JSON.stringify(data),
        })
        .then (function(response) {
        return response.json();
        })
        .then (x => {
            console.log(x);
            alert("Welcome");
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
    color: rgb(7, 6, 6);
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