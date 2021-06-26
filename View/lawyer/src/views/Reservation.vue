<template>
    <form @submit.prevent="submitReservation">
      <div class="dash">
        <center><router-link to="/dash" ><button>Check My Reservations</button></router-link></center>
      </div>
      <label>Reservation</label>
      <input type="date" max="25-06-2021" required v-model="date">
      <input type="text" placeholder="Subject" required v-model="Subject">
      <select id="cren" placeholder="Creneau" v-model="time_slot">
          <option value="1">From 11:00AM to 11:30AM</option>
          <option value="2">From 12:00PM to 12:30PM</option>
          <option value="3">From 13:00PM to 13:30PM</option>
          <option value="4">From 14:00PM to 14:30PM</option>
          <option value="5">From 15:00PM to 15:30PM</option>
      </select>

      <div class="submit">
          <button v-on:click="show">Submit</button>
      </div>
  </form>
</template>

<script>

export default {
  name: "Reservation",
  data() {
    return {
      subject: "",
      date: "",
      time_slot: "",
    };
  },
  methods: {
    async submitReservation() {
      let res = await fetch(
        "http://localhost/Brief6/ApiReservationController/createReservation",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
              user_id: sessionStorage.getItem("id_user"),
            creneau_id: this.time_slot,
            Subject: this.Subject,
            date: this.date,
          }),
        }
      );
      let data = await res.json();
      console.log(data);
    this.show = true;
    },
    mylogout: function () {
      sessionStorage.removeItem("id_user");
      this.$router.push({ name: "Form" });
    },
  show: function () {
      alert("Reservation Done!");
  }
  },
};


</script>
<style scoped lang="scss">

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
input, select{
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
    text-decoration: none;
    color: white;
    border-radius: 20px;
}
.submit {
    text-align: center;
}
// #dash {
//   font-family: Avenir, Helvetica, Arial, sans-serif;
//   -webkit-font-smoothing: antialiased;
//   -moz-osx-font-smoothing: grayscale;
//   text-align: center;
//   color: #2c3e50;
//   align-self: center;
// }
#dash {
  padding: 30px;

  button {
    font-weight: bold;
    color: #2c3e50;
    text-decoration: none;
    border: 1px dotted rgb(86, 85, 170);
    border-radius: 20px;
    border-spacing: 1px;
    padding: 10px;
    margin: 10px;
    &.router-link-exact-active {
      color: #283672;
    }
}:hover {
      background-color: #aeb7df;
    }
  }
</style>