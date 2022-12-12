<template>
  <div class="vue-tempalte">
    <form class="vertical-center inner-block">
      <h3>Edit PayPal Profile</h3>
      <div class="form-group">
        <label class="fw-bold">First Name</label>
        <input
          type="text"
          v-model="form.first_name"
          id="firstname"
          class="form-control form-control-lg"
        />
        <span class="text-danger" v-if="errors.first_name">{{ errors.first_name[0] }}</span>
      </div>
      <div class="form-group mt-2">
        <label class="fw-bold">Last Name</label>
        <input
          type="text"
          v-model="form.last_name"
          id="LastName"
          class="form-control form-control-lg"
        />
        <span class="text-danger" v-if="errors.last_name">{{ errors.last_name[0] }}</span>
      </div>
      <div class="form-group mt-2">
        <label class="fw-bold">Paypal Email</label>
        <input
          type="text"
          v-model="form.paypal_email"
          id="email"
          class="form-control form-control-lg"
        />
        <div id="passwordHelpBlock" class="form-text">Eg:example@gmail.com</div>
        <span class="text-danger" v-if="errors.paypal_email">{{ errors.paypal_email[0] }}</span>
      </div>
      <button
        type="submit"
        @click.prevent="updatePaypalAcc"
        class="btn btn-dark btn-lg btn-block mt-3"
      >Update Paypal Profile</button>
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
        first_name: "",
        last_name: "",
        paypal_email: "",
      },
      errors:[],
    };
  },
  created() {
    axios
      .post("/api/getAuthPaypalProfile", {
        cus_id: this.authCus.cus_id,
      })
      .then((response) => {
        if (response.data.length !== 0) {
          this.form = response.data;
        }
      });
  },
  methods: {
    updatePaypalAcc() {
      this.errors = [];
      axios
        .post("/api/editAuthPaypalProfile", {
          first_name: this.form.first_name,
          last_name: this.form.last_name,
          paypal_email: this.form.paypal_email,
          cus_id: this.authCus.cus_id,
        })
        .then((response) => {
          swal("Success", "Successfully update paypal profile!!", "success").then(
            (value) => {
              this.$router.push("/customer/profileNav");
            }
          );
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
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
</style>