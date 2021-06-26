<template>
<div class="dashboard">
    <button><router-link to="/Reservation">Return</router-link></button>
    <!-- /* Affichage */ -->
    <div class="container">
      <center><h1>My Reservations</h1></center>
        <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Creneau</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="table in tables" :key="table.Reservation_id">
                  <th scope="row">{{ table.Date }}</th>
                  <td>{{ table.Creneau }}</td>
                  <td>{{ table.Subject }}</td>

                  <td class="d-flex flex-row">
                    <form>
                      <input type="hidden" name="id" value="" />
                      <button
                        @click="edit(table)">Edit
                      </button>
                    </form>
                    <form>
                      <input type="hidden" name="id" value="" />
                      <button
                        @click="delete(table.Reservation_id)">Delete
                      </button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
    </div>
</div>
</template>

<script>
export default {
  name: "dashboard",
  data() {
    return {
      date: "",
      id_reservation: "",
      creneau: "",
      subject,
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
    AjoutReseravtion() {
      this.pageAjouter = true;
      this.pageUpdate = false;
      this.redirection();
    },
    edit(table) {
      this.pageUpdate = true;
      this.pageAjouter = false;
      sessionStorage.setItem("date", table.jour);
      sessionStorage.setItem("creneau", table.time_out);
      sessionStorage.setItem("subject", table.note);
      sessionStorage.setItem("Reservation_id", table.Reservation_id);
      this.redirection();
    },
  },
  async created() {
    const reference = {
      reference: sessionStorage.getItem("reference"),
    };
    var res = await fetch(
      "http://localhost/Brief6/ApiCrudsReservation/afficherReservation",
      {
        method: "POST",
        header: "Content-type: application/json",
        body: JSON.stringify(reference),
      }
    );
    if (res.status === 200) {
      this.tables = await res.json();
    }
  },
};
</script>
<style scoped lang="scss">

</style>