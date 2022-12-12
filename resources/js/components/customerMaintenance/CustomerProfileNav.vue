<template>
  <div class="container">
    <h1>My Profile</h1>
    <hr />
    <div class="card shadow ps-2 pe-2 mb-2 bg-body border-0 rounded ms-5 me-5">
      <div class="card-body ">
        <h5 class="fw-bold text-center">Welcome <em>{{ authCus.name }}</em></h5>
        <div class="d-grid gap-2 col-6 mx-auto">
          <router-link class="btn btn-dark" :to="{name:'editProfile'}">Edit Profile</router-link>
          <router-link class="btn btn-dark" :to="{name:'editPaypalProfile'}">Edit Paypal Profile</router-link>
          <router-link class="btn btn-dark" :to="{name:'changePassword'}">Change Password</router-link>

        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState} from "pinia";
import { useAuthStore } from "../../store/auth";
export default {
  data() {
    return {};
  },
  methods: {

  },
  computed: {
    ...mapState(useAuthStore, ["authCus"]),
  },
};
</script>