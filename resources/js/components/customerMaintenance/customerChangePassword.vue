<template>
  <div class="vue-tempalte">
    <form class="vertical-center inner-block">
      <h3>Change Password</h3>
      <div class="form-group">
        <label class="fw-bold">Old Password</label>
        <input
          type="password"
          v-model="form.oldPassword"
          id="old-pass"
          class="form-control form-control-lg"
        />
        <span class="text-danger" v-if="errors.old_password">{{ errors.old_password[0] }}</span>
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
        <span class="text-danger" v-if="errors.new_password">{{ errors.new_password[0] }}</span>
      </div>
      <div class="form-group">
        <label class="fw-bold">Confirm Password</label>
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
        @click.prevent="changePassword"
        class="btn btn-dark btn-lg btn-block mt-3"
      >Update Profile</button>
    </form>
  </div>
</template>
<script>
import { mapState } from "pinia";
import { useAuthStore } from "../../store/auth";

export default {
  data() {
    return {
      form: {
        oldPassword: "",
        newPassword: "",
        confirmPassword: "",
      },
      errors: [],
    };
  },
  methods: {
    changePassword() {
      this.errors = [];
      axios
        .post("/api/changePassword", {
          old_password: this.form.oldPassword,
          new_password: this.form.newPassword,
          password_confirmation: this.form.confirmPassword,
          cusID: this.authCus.cus_id,
        })
        .then((response) => {
          swal("Success", "Successfully change password!!", "success").then(
            (value) => {
              this.$router.push("/customer/profileNav");
            }
          );
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            console.log(this.errors);
          }
        });
    },
  },
  computed: {
    ...mapState(useAuthStore, ["authCus"]),
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