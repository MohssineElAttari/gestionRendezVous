<template>
  <div class="container">
    <form class="form_container" @submit.prevent="validation">
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
import swal from "sweetalert";
export default {
  data() {
    return {
      userFirstName: "",
      userLastName: "",
      userCIN: "",
      userEmail: "",
      data: undefined,
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
          userEmail: this.userEmail,
        }
      );
      console.log(res.data.state);
      return res.data;
    },
    async validation() {
      this.data = await this.signup();
      if (this.data.state == "vide") {
        swal("failed !", "please fill all the fields!", "warning");
      } else {
        sessionStorage.setItem("reference",this.data.reference);
        swal(
          "Good job!",
          "Congratulations ! Your information has been registered ! \n\n\n reference :" +
            this.data.reference,
          "success"
        );
        this.$router.push('/Authentification');
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