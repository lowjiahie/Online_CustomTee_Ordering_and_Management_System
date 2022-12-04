<template>
  <div class="vue-tempalte">
    <form class="vertical-center inner-block">
      <h3>Sign Up</h3>
      <div class="form-group">
        <label class="fw-bold">Full Name</label>
        <input type="text" v-model="form.name" id="name" class="form-control form-control-lg" />
        <span class="text-danger" v-if="authErrors.name">{{ authErrors.name[0] }}</span>
      </div>
      <div class="form-group mt-2">
        <label class="fw-bold">Email address</label>
        <input type="email" v-model="form.email" id="email" class="form-control form-control-lg" />
        <div id="passwordHelpBlock" class="form-text">Eg:example@gmail.com</div>
        <span class="text-danger" v-if="authErrors.email">{{ authErrors.email[0] }}</span>
      </div>
      <div class="form-group mt-2">
        <label class="fw-bold">Password</label>
        <input
          type="password"
          v-model="form.password"
          id="password"
          class="form-control form-control-lg"
        />
        <div
          id="passwordHelpBlock"
          class="form-text"
        >Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</div>
        <span class="text-danger" v-if="authErrors.password">{{ authErrors.password[0] }}</span>
      </div>
      <div class="form-group mt-2">
        <label class="fw-bold">Confirm Password</label>
        <input
          type="password"
          v-model="form.password_confirmation"
          id="password_confirmation"
          class="form-control form-control-lg"
        />
        <span
          class="text-danger"
          v-if="authErrors.password_confirmation"
        >{{ authErrors.password_confirmation[0] }}</span>
      </div>
      <button
        type="submit"
        @click.prevent="register(form)"
        class="btn btn-dark btn-lg btn-block mt-3"
      >Sign Up</button>
      <p class="forgot-password text-right">
        Already registered
        <router-link :to="{name: 'login'}">Sign In?</router-link>
      </p>
    </form>
  </div>
</template>
<script>
import { mapState, mapActions } from "pinia";
import { useAuthStore } from "../../store/auth";

export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  methods: {
    ...mapActions(useAuthStore, ["register", "resetErrors"]),
  },
  computed: {
    ...mapState(useAuthStore, ["authErrors"]),
  },
};
</script>
<style scoped>
.vertical-center {
  width: 100%;
  height: 100%;
}

.vertical-center {
  display: flex;
  text-align: left;
  justify-content: center;
  flex-direction: column;
}
.inner-block {
  width: 450px;
  margin: auto;
  background: #ffffff;
  box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.2);
  padding: 40px 55px 45px 55px;
  border-radius: 15px;
  transition: all 0.3s;
}
.vertical-center .form-control:focus {
  border-color: #2554ff;
  box-shadow: none;
}
.vertical-center h3 {
  text-align: center;
  margin: 0;
  line-height: 1;
  padding-bottom: 20px;
}
label {
  font-weight: 500;
}
.forgot-password,
.forgot-password a {
  text-align: right;
  font-size: 13px;
  padding-top: 10px;
  color: #7a7a7a;
  margin: 0;
}
.forgot-password a {
  color: #2554ff;
}
</style>