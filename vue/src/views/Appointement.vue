<template>
  <div>
    <div class="auth">
      <h1>this is Authentication page</h1>
      <AppointementForm />
    </div>
  </div>
</template>

<script>
import AppointementForm from "@/components/AppointementForm.vue";
export default {
  name: "Appointement",
  components: {
    AppointementForm,
  },
};
</script>

<style>
</style>