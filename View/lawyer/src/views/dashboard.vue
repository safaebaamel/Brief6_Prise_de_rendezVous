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

                  <td>
                    <form>
                      <input name="id" value="" />
                      <button
                        @click="edit(table)">Edit
                      </button>
                    </form>
                    <form>
                      <input name="id" value="" />
                      <button
                        @click="delete(table.Reservation_id)">Delete
                      </button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table></center>
    </div>
</div>
</template>

// // <script>
// export default {
//   name: "dashboard",
//   data() {
//     return {
//       date: "",
//       Reservation_id: "",
//       creneau_id: "",
//       Subject,
//       tables: {},
//       pageUpdate: false,
//     };
//   },
//   methods: {
//     delete(id) {
//       console.log(id);
//       const data = {
//         Reservation_id: id,
//       };
//       var res = fetch(
//         "http://localhost/Brief6/ApiReservationController/deleteReservation",
//         {
//           method: "POST",
//           header: "Content-type: application/json",
//           body: JSON.stringify(data),
//         }
//       );
//       if (res.status === 200) {
//         const result = res.json();
//         console.log(result.message);
//       }
//     },
//     edit(table) {
//       this.pageUpdate = true;
//       sessionStorage.setItem("date", table.date);
//       sessionStorage.setItem("creneau_id", table.creneau_id);
//       sessionStorage.setItem("Subject", table.Subject);
//       sessionStorage.setItem("Reservation_id", table.Reservation_id);
//       this.redirection();
//     },
//   },
//   async created() {
//     const reference = {
//       reference: sessionStorage.getItem("reference"),
//     };
//     var res = await fetch(
//       "http://localhost/Brief6/ApiReservationController/readReservation",
//       {
//         method: "POST",
//         header: "Content-type: application/json",
//         body: JSON.stringify(reference),
//       }
//     );
//     if (res.status === 200) {
//       this.tables = await res.json();
//     }
//   },
// };
// </script>
<style scoped lang="scss">

</style>