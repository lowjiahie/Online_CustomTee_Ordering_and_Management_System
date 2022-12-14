<template>
  <div class="vue-tempalte">
    <form class="vertical-center inner-block">
      <h3>Edit Profile</h3>
      <div class="form-group">
        <label class="fw-bold">Email address</label>
        <p>{{ authCus.email }}</p>
      </div>
      <div class="form-group">
        <label class="fw-bold">Full Name</label>
        <input type="text" v-model="form.name" id="name" class="form-control form-control-lg" />
        <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
      </div>
      <div class="form-group mt-2">
        <label class="fw-bold">Phone Number</label>
        <input type="text" v-model="form.phone_num" id="name" class="form-control form-control-lg" />
         <div
          id="passwordHelpBlock"
          class="form-text"
        >(eg.0163762534 or 01137423984)</div>
        <span class="text-danger" v-if="errors.phone_num">{{ errors.phone_num[0] }}</span>
      </div>
      <div class="form-group mt-2">
        <label class="fw-bold">Address</label>
        <textarea
          class="form-control"
          v-model="form.address"
          rows="4"
          cols="50"
          placeholder="--enter your address here--"
        ></textarea>
        <span class="text-danger" v-if="errors.address">{{ errors.address[0] }}</span>
      </div>
      <button
        type="submit"
        @click.prevent="updateProfile"
        class="btn btn-dark btn-lg btn-block mt-3"
      >Update Profile</button>
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
        address: "",
        phone_num: "",
      },
      errors:[],
    };
  },
  created() {
    axios
      .post("/api/getAuthCusProfile", {
        cus_id: this.authCus.cus_id,
      })
      .then((response) => {
        this.form = response.data;
      });
  },
  methods: {
    ...mapActions(useAuthStore, ["setAuthCus"]),
    updateProfile() {
      this.errors = [];
      axios
        .post("/api/editAuthCusProfile", {
          name: this.form.name,
          address: this.form.address,
          phone_num: this.form.phone_num,
          cus_id: this.authCus.cus_id,
        })
        .then((response) => {
          this.setAuthCus(this.form);
          swal("Success", "Successfully update profile!!", "success").then(
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