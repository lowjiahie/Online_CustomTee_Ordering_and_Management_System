<template>
  <div class="vue-tempalte">
    <form class="vertical-center inner-block">
      <h3>Forgot Password</h3>
      <div class="form-group">
        <label class="fw-bold">Email address</label>
        <input type="email" v-model="email" class="form-control form-control-lg" />
        <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
        <span class="text-success" v-if="validMsg">{{ validMsg }}</span>
      </div>
      <button
        type="button"
        @click.prevent="sendToken"
        class="btn btn-dark btn-lg btn-block mt-3"
        v-if="!loading"
      >Send Email</button>
      <div v-else class="d-flex justify-content-center mt-2">
        <div class="spinner-border" role="status">
          <span class="visually-hidden" role="status">Loading...</span>
        </div>
        <p class="fw-bold p-2">Sending Email......</p>
      </div>
      <p v-if="!loading" class="forgot-password text-right">
        Back to
        <router-link :to="{name: 'login'}">Login Page?</router-link>
      </p>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      email: "",
      validMsg: "",
      errors: [],
      loading: false,
    };
  },
  methods: {
    sendToken() {
      this.errors = [];
      this.validMsg = "";
      this.loading = true;
      axios
        .post("/api/sendToken", {
          email: this.email,
        })
        .then((response) => {
          this.loading = false;
          this.validMsg = "Email has been sent to " + response.data.email;
        })
        .catch((error) => {
          this.loading = false;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            console.log(this.errors);
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