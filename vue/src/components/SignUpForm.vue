<template>
  <div class="container">
    <form class="form_container" @submit.prevent="signup">
      <div class="form_input_container">
        <label class="form_label" for="userFirstName">First Name</label>
        <input class="form_input" type="text" v-model="userFirstName" />
      </div>
      <div class="form_input_container">
        <label class="form_label" for="userLastName">Last Name</label>
        <input class="form_input" type="text" v-model="userLastName" />
      </div>
      <div class="form_input_container">
        <label class="form_label" for="userCIN">CIN</label>
        <input class="form_input" type="text" v-model="userCIN" />
      </div>
      <div class="form_input_container">
        <label class="form_label" for="userEmail">Email</label>
        <input class="form_input" type="text" v-model="userEmail" />
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
      userFirstName: "",
      userLastName: "",
      userCIN: "",
      userEmail: ""
    };
  },
  methods: {
    async signup() {
      // console.log(5555);
      const res = await axios.post(
        "http://localhost/gRendezVous/ApiUser/create",
        {
          userFirstName: this.userFirstName,
          userLastName: this.userLastName,
          userCIN: this.userCIN,
          userEmail: this.userEmail
        }
      );
      alert(res.data.message);
      if (res.data.state) {
        console.log(res.data.reference);
      }
    }
  }
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
  border: 1px dashed #42b983;
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
  border-bottom: 2px solid #42b983;
}
.form_input:focus {
  border: 2px solid #42b983;
  outline: none;
}
.form_button {
  display: block;
  padding: 10px 20px;
  background-color: #42b983;
  border: none;
  border-radius: 20px;
}
</style>