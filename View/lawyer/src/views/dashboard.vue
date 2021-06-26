<template>
<div class="dashboard">
    <button><router-link to="/Reservation">Return</router-link></button>
    <!-- /* Affichage */ -->
    <div class="container">
      <center><h1>My Reservations</h1></center>
      <table class="">
        <thead>
          <tr>
            <th>Date</th>
            <th>Creneau</th>
            <th>Sujet</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="A in RDV" :key="A.id">
            <th>{{ A.date }}</th>
            <td>{{ A.creneau }}</td>
            <td>{{ A.Sujet }}</td>
            <td>
              <button
                class=""
                @click="delAppointment(A.id, A.date)"
              >
                <i class="far fa-trash-alt"></i>
              </button>
              <button
                class=""
                @click="editAppointment(A.id, A.date, A.sujet, A.idcreneaux)"
              >
                <i class="fas fa-edit"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
</template>
<style scoped lang="scss">

// #dashboard {
//   padding: 30px;
//   color: white;
//  text-decoration: none;

//   a {
//     font-weight: bold;
//     color: #ffffff;
//     text-decoration: none;
//     border: 1px dotted rgb(86, 85, 170);
//     border-radius: 20px;
//     border-spacing: 1px;
//     padding: 10px;
//     margin: 10px;
//     &.router-link-exact-active {
//       color: #ffffff;
//     }
// }:hover {
//       background-color: #aeb7df;
//     }
//   }
</style>