<template>
    <form @submit.prevent="submitReservation">
      <label>Reservation</label>
      <input type="date" required v-model="date">
      <input type="text" placeholder="Subject" required v-model="subject">
      <select id="cren" v-model="creneau">
          <option value="1">From 11:00AM to 11:30AM</option>
          <option value="2">From 12:00PM to 12:30PM</option>
          <option value="3">From 13:00PM to 13:30PM</option>
          <option value="4">From 14:00PM to 14:30PM</option>
          <option value="5">From 15:00PM to 15:30PM</option>
      </select>

      <div class="submit">
          <button>Submit</button>
      </div>
  </form>
</template>

<script>

export default {
  
}

</script>
<style scoped>
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
    color: white;
    border-radius: 20px;
}
.submit {
    text-align: center;
}

</style>