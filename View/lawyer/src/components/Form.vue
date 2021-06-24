<template>
  <form @submit.prevent="handleSubmit">
      <label>Insert Your Reference</label>
      <input type="text" required v-model="Reference">

      <div class="submit">
          <button>Submit</button>
      </div>
  </form>
  
  
</template>

<script>
export default {
    name: 'Form',
    data() {
        return {
            Reference: '',
            isAuth: false
        }
    },
    methods:{
        async handleSubmit(){

        const data = {
            Reference: this.Reference,
        };
      console.log(data);
       await fetch("http://localhost/Brief6/ApiUserController/getInfoFromReference",{
           method : "POST",
           header: "Content-type: application/json",
           body: JSON.stringify(data)
       }  )
        .then(response => response.text())
        .then(function(result) {
            var obj = JSON.parse(result)
            console.log(obj);
            })

        if (obj.response == "true") {
                sessionStorage.setItem("Reference", this.Reference);
                this.isAuth = true;
                this.redirection();
        } 
        },
        redirection() {
        if (this.isAuth == true) {
            this.$router.push({ path: "/Reservation" });
        } else {
            this.$router.push({ path: "/Home" });
        }
    },
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