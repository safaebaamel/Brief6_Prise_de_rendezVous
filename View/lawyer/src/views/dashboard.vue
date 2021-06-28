<template>
<div class="dashboard">
    <button><router-link to="/Reservation">Return</router-link></button>
    <div class="container">
      <center><h1>My Reservations</h1></center>
        <center><table>
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Creneau</th>
                  <th>Subject</th>
                  <th colspan="2">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="table in tables" :key="table.Reservation_id">
                  <th scope="row">{{ table.date }}</th>
                  <td>{{ table.creneau_id}}</td>
                  <td>{{ table.Subject }}</td>
                  <td><button @click="getRDV_id(table.Reservation_id)" >Edit</button></td>
                  <td><button @click="deleteReservation(table.Reservation_id)" >Delete</button></td>

                </tr>
              </tbody>
            </table></center>
    </div>
</div>
</template>

// // <script>
export default {
  name: "dashboard",
  data() {
    return {
      date: "",
      Reservation_id: "",
      creneau_id: "",
      Subject: "",
      tables: {},
      pageUpdate: false,
    };
  },
  methods: {
    deleteReservation(rdv_id) {
        console.log(rdv_id);
          var myHeaders = new Headers();
          myHeaders.append("Content-Type", "application/json");

          var raw = JSON.stringify({
            "Reservation_id": rdv_id
          });

          var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
          };

          fetch("http://localhost/Brief6/ApiReservationController/deleteReservation", requestOptions)
            .then(response => response.text())
            .then(function(result) {
                console.log(result),
                location.reload()
            })
            .catch(error => console.log('error', error));
      
    },
    delete(id) {
      console.log(id);
      const data = {
        Reservation_id: id,
      };
      var res = fetch(
        "http://localhost/Brief6/ApiReservationController/deleteReservation",
        {
          method: "POST",
          header: "Content-type: application/json",
          body: JSON.stringify(data),
        }
      );
      if (res.status === 200) {
        const result = res.json();
        console.log(result.message);
      }
    },
    edit(table) {
      this.pageUpdate = true;
      sessionStorage.setItem("date", table.date);
      sessionStorage.setItem("creneau_id", table.creneau_id);
      sessionStorage.setItem("Subject", table.Subject);
      sessionStorage.setItem("Reservation_id", table.Reservation_id);
      this.redirection();
    },

    getClientAppointment: async function () {
      let res = await fetch(
        "http://localhost/Brief6/ApiReservationController/GetFromId",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            user_id: sessionStorage.getItem("id_user"),
          }),
        }
      );
      let data = await res.json();
    
      console.log(data);
      this.tables = data;
    },
  
  },
beforeMount(){
// this.created();
this.getClientAppointment();
},
  


};


</script>
<style scoped lang="scss">
table, td, th {
  border: 1px dotted rgb(6, 41, 98);
  text-align: center;
  
}

table {
  width: 60%;

  border-collapse: collapse;
}
</style>

