<template>
  <div>
    <!-- Default form contact -->
    <form class="text-center border border-light p-5" action="" v-if="up">
      <p class="h4 mb-4">Update</p>
      <!-- Subject -->

      <div class="form-group">
        <textarea
          class="form-control rounded-0"
          id="exampleFormControlTextarea2"
          rows="3"
          placeholder="subject"
          v-model="subject"
        ></textarea>
      </div>

      <!-- Date -->
      <input
        type="date"
        id="defaultContactFormEmail"
        class="form-control mb-4"
        placeholder="date"
        v-model="date"
      />

      <!-- Subject -->
      <label>TimeSlot</label>
      <select class="browser-default custom-select mb-4" v-model="inputUser">
        <option>{{inputUser}}</option>
        <option
          v-for="(time, index) in times"
          :value="time.start_at+' To '+time.end_at"
          :key="index"
        >
          {{ time.start_at }} To {{ time.end_at }}
        </option>
      </select>
      <br />
      <!-- Send button -->
      <button class="btn btn-info btn-block" type="submit" @click.prevent=submitUpdatedData()>Update</button>
    </form>
    <!-- Default form contact -->

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">subject</th>
          <th scope="col">Date</th>
          <th scope="col">time start</th>
          <th scope="col">time end</th>
          <th scope="col">operation</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(resultat, index) in results"
          :value="index"
          :key="resultat.appointement_id"
        >
          <th scope="row">
            {{ index + 1 }}
          </th>
          <td>{{ resultat.user_subject }}</td>
          <td>{{ resultat.c_date }}</td>
          <td>{{ resultat.start_at }}</td>
          <td>{{ resultat.end_at }}</td>
          <td colspan="2">
            <button
              type="button"
              class="btn btn-success"
              @click="update(resultat)"
            >
              Update
            </button>
            |
            <button
              type="button"
              class="btn btn-danger"
              @click="removeAppointment(resultat.appointement_id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
import { reactive, ref, toRefs } from "vue";
import swal from "sweetalert";
export default {
  // data() {
  //   return {
  //     times: "",
  //     id: "",
  //   };
  // },
  methods: {
    async deleteApp(id) {
      const res = await axios.get(
        `http://localhost/gRendezVous/ApiAppointement/deleteAnAppointment/${id}`
      );
      console.log(res.data);
    },
  },
  setup() {
    //composition api (vue3 o)
    let up = ref(false);
    let id_appointtment = ref('');
    let results = ref([]);
    let data = reactive({
      subject: null,
      date: null,
      start_at: null,
      end_at: null,
    });
      let times = ref([]);
      let inputUser = ref('');
      let OldAppointment = ref('');

    // let subject = ref(null);
    // let x = {}

    // console.dir(data.constructor);
    // iife : Immediately Invoked Function Expression : (function(){})();
    (async function () {
      const res = await axios.get(
        `http://localhost/gRendezVous/ApiAppointement/showMyAppointments/${sessionStorage.getItem(
          "userId"
        )}`
      );
      console.log(res.data);
      // return res.data;
      results.value = await [...res.data];
      console.log(results.value);
    })();

    const removeAppointment = (id) => {
      let child = event.target;
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          console.log(id);
          (async function () {
            const res = await axios.get(
              `http://localhost/gRendezVous/ApiAppointement/deleteAnAppointment/${id}`
            );
            console.log(res.data);
          })();
          let respond = true;
          if (respond) {
            console.log(child);
            child.closest("tr").remove();
          }
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    };

    async function update(obj) {
      // console.log(document.getElementById("test").options);
      // console.log(5555);
      console.log(obj);
      id_appointtment.value = obj.appointement_id;
      up.value = true;
      data.subject = obj.user_subject;
      data.date = obj.c_date;
      data.start_at = obj.start_at;
      data.end_at = obj.end_at;
      OldAppointment.value = inputUser.value = `${data.start_at} To ${data.end_at}`;

      // ( function () {
        const res = await axios.post(
          "http://localhost/gRendezVous/ApiAppointement/checkAvailableTimes",
          {
            c_date: obj.c_date,
          }
        );
        // console.log(res.data);
        // // data.times = [...data.times,...res.data];
        // console.log(res.data.times);
        // data.times = data.times.concat(res.data.times);
        times.value = await res.data.times;
        console.log(times);
        // data.times.;
      // })();

      // console.log(data);
      // console.log(data.times);
    }
    function submitUpdatedData(){

      if(OldAppointment.value!==inputUser.value){
        let id  = id_appointtment.value;
        let [start,end] = inputUser.value.split(' To ');
        console.log(start,end,id);

        console.log('nice')
      }else {
        alert('you cant\' do that!!!');
      }
    }
    return { results, update, removeAppointment, ...toRefs(data), up,times,inputUser,OldAppointment,submitUpdatedData };
  },
};
</script>

<style>
</style>