<template>
  <div class="container">
    <form class="form_container" @submit.prevent="valider()">
      <!-- @submit.prevent="valider" -->
      <div class="form_input_container">
        <label class="form_label" for="date">Date Of Appointement</label>
        <input
          class="form_input"
          type="date"
          v-model="dateOfAppointement"
          @change="getTimes"
        />
      </div>
      <div class="form_input_container">
        <label class="form_label" for="date">Time Of Appointement</label>
        <select id="test" class="form_input" name="time" v-model="id">
          <option value="" selected>Choose your Appointement</option>
          <option
            v-for="(time, index) in times"
            :value="time.timeslot_id"
            :key="index"
          >
            {{ time.start_at }} To {{ index }} {{ time.end_at }}
          </option>
        </select>
      </div>
      <div class="form_input_container">
        <label class="form_label" for="date">Description</label>
        <input class="form_input" type="text" v-model="description" />
      </div>
      <button type="submit" class="form_button">Confirm</button>
    </form>
  </div>
</template>
<script>
// import swal from "sweetalert";
import axios from "axios";
export default {
  data() {
    return {
      dateOfAppointement: "",
      description: "",
      times: "",
      id: "",
      resultat: undefined,
      state: undefined,
    };
  },
  methods: {
    async getTimes() {
      console.log(document.getElementById("test").options);
      // console.log(5555);
      const res = await axios.post(
        "http://localhost/gRendezVous/ApiAppointement/checkAvailableTimes",
        {
          c_date: this.dateOfAppointement,
        }
      );
      console.log(res.data);
      this.times = res.data.times;
      return res.data.state;
    },
    async create() {
      // this.resultat = await this.getTimes();
      // console.log(this.resultat);

      const res = axios.post(
        "http://localhost/gRendezVous/ApiAppointement/createAnAppointement",
        {
          userId_fk: sessionStorage.getItem("userId"),
          timeslot_id_fk: this.id,
          user_subject: this.description,
          c_date: this.dateOfAppointement,
        }
      );
      console.log(await res);
    },
    async valider() {
      this.state = await this.getTimes();
      //  console.log(this.state);
      if (this.state) {
        this.create();
      }
    },
  },
};
</script>

<style>
.container {
  display: flex;
  justify-content: center;
}
.form_container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  border: 1px solid #000000;
  border-radius: 20px;
  padding: 20px 30px;
  width: 25%;
}
.form_label {
  display: block;
  float: left;
}
.form_input_container {
  display: block;
  margin: 10px;
  width: 100%;
}
.form_input {
  width: 100%;
  padding: 10px 5px;
  margin: 5px auto;
  border: 0 none #ccc;
  border-bottom: 2px solid #092dfa;
}
.form_input:focus {
  border: 2px solid #1e2c7e;
  outline: none;
}
.form_button {
  display: block;
  padding: 10px 20px;
  background-color: #092dfa;
  border: none;
  border-radius: 20px;
}
</style>