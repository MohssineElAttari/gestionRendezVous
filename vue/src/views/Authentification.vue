<template>
  <div class="auth">
    <h1>this is Authentication page</h1>
    <AuthenticationForm />
  </div>
</template>

<script>
import AuthenticationForm from "@/components/AuthenticationForm.vue";
export default {
  name: "Authentification",
  components: {
    AuthenticationForm,
  },
};
</script>

<style>
.auth {
  background-image: url("../assets/paul.jpg");
  height: 820px;
  padding: 20px;
}
</style>