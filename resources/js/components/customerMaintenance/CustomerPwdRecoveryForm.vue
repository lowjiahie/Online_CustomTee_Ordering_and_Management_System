<template>
  <div class="vue-tempalte">
    <form v-if="showForm" class="vertical-center inner-block">
      <h3>Password Recovery</h3>
      <div class="form-group">
        <label class="fw-bold">Email</label>
        <p class="fw-bold fs-6">Your email {{ this.cus.email }}</p>
      </div>
      <div class="form-group">
        <label class="fw-bold">New Password</label>
        <input
          type="password"
          v-model="form.newPassword"
          id="new-pass"
          class="form-control form-control-lg"
        />
        <div
          id="passwordHelpBlock"
          class="form-text"
        >Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</div>
        <span class="text-danger" v-if="errors.password">{{ errors.password[0] }}</span>
      </div>
      <div class="form-group">
        <label class="fw-bold">Confirm New Password</label>
        <input
          type="password"
          v-model="form.confirmPassword"
          id
          class="form-control form-control-lg"
        />
        <span
          class="text-danger"
          v-if="errors.password_confirmation"
        >{{ errors.password_confirmation[0] }}</span>
      </div>
      <button
        type="submit"
        @click.prevent="passwordRecovery"
        class="btn btn-dark btn-lg btn-block mt-3"
      >Update New Password</button>
    </form>
    <div class="container" v-if="showExpire">
      <h1 class="text-secondary">Token Expired::404</h1>
    </div>

    <div v-if="loading" class="d-flex justify-content-center my-auto" >
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        newPassword: "",
        confirmPassword: "",
      },
      cus: {
        cus_id: "",
        email: "",
      },
      loading: true,
      showForm: false,
      showExpire: false,
      errors: [],
    };
  },
  created() {
    this.validateToken();
  },
  methods: {
    validateToken() {
      axios
        .get(`/api/validateToken/${this.$route.params.token}`)
        .then((response) => {
          this.loading = false;
          if (response.data[0] !== 401) {
            this.showForm = true;
            this.cus = response.data;
          } else {
            this.showExpire = true;
          }
        });
    },

    passwordRecovery() {
      this.errors = [];
      axios
        .post("/api/passwordRecovery", {
          password: this.form.newPassword,
          password_confirmation: this.form.confirmPassword,
          cus_id: this.cus.cus_id,
        })
        .then((response) => {
          swal(
            "Success",
            "Successfully recovery your password!!",
            "success"
          ).then((value) => {
            this.$router.push("/customer/login");
          });
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
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
