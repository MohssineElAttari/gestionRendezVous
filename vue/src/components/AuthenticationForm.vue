<template>
  <div class="container">
    <form class="form_container" @submit.prevent="valider">
      <div class="form_input_container">
        <label class="form_label" for="reference">reference</label>
        <input class="form_input" type="text" v-model="reference" />
      </div>
      <button type="submit" class="form_button">Confirm</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      reference: "",
    };
  },
  methods: {
    async valider() {
      // console.log(5555);
      const res = await axios.post(
        "http://localhost/gRendezVous/ApiUser/checkUser",
        {
          Reference: this.reference,
        }
      );
      if (res.data.state) {
        sessionStorage.setItem("userId", res.data.userId);
        this.$router.push("/Authentification");
        // console.log(sessionStorage.getItem("userId"));
        // console.log(this.userId);
        this.userId = res.data.userId;
        this.$router.push("/Appointement");
      }
    },
  },

  created() {
    this.reference = sessionStorage.getItem("reference");
    sessionStorage.setItem("reference", "");
    // sessionStorage.setItem("userId", this.userId);
    // console.log(sessionStorage.getItem("userId"));
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
  border: 2px solid #0078de;
  outline: none;
}
.form_button {
  display: block;
  padding: 10px 20px;
  background-color: #0078de;
  border: none;
  border-radius: 20px;
  color: white;
  font-weight: bold;
}
</style>