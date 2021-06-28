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
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="table in tables" :key="table.Reservation_id">
                  <th scope="row">{{ table.date }}</th>
                  <td>{{ table.creneau_id }}</td>
                  <td>{{ table.Subject }}</td>
                  <th>Delete</th>
                  <th>Edit</th>

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
  //   async created() {
  //   // const reference = {
  //   //   reference: sessionStorage.getItem("reference"),
  //   // };
  //   var res = await fetch(
  //     "http://localhost/Brief6/ApiReservationController/GetFromId",
  //     {
  //       method: "POST",
  //       header: "Content-type: application/json",
  //       body: JSON.stringify(
  //         {
  //           "user_id" : sessionStorage.getItem("id_user")
  //         }
  //       ),
  //     }
  //   );
  //   if (res.status === 200) {
  //     this.tables = await res.json();
  //     console.log(this.tables);
  //   }
  // },

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

</style>

