<template>
  <div class="SignUp">
    <h1>this is sign up page</h1>
    <SignUpForm />
  </div>
</template>

<script>
import SignUpForm from "@/components/SignUpForm.vue";
export default {
  name: "SignUp",
  components: {
    SignUpForm,
  },
};
</script>

<style>
.SignUp{
background-image: url("../assets/paul.jpg");
height: 820px;
padding: 20px;
}

</style>