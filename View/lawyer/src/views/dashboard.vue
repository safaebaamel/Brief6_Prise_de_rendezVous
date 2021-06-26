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
              <button>
              Delete
              </button>
              <button>
              Edit
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
</template>
<style scoped lang="scss">

</style>