<template>
  <div class="vue-tempalte">
    <form class="vertical-center inner-block">
      <h3>Sign In</h3>
      <div class="form-group">
        <label class="fw-bold">Email address</label>
        <input type="email" class="form-control form-control-lg" />
      </div>
      <div class="form-group mt-2">
        <label class="fw-bold">Password</label>
        <input type="password" class="form-control form-control-lg" />
      </div>
      <button type="submit" class="btn btn-dark btn-lg btn-block mt-3">Sign In</button>
      <p class="forgot-password text-right mt-2">
        <router-link :to="{name:'pwdRecovery'}">Forgot password ?</router-link>
      </p>
      <p class="forgot-password text-center">
        Dont have account
        <router-link to="/customer/register">Sign Up?</router-link>
      </p>
    </form>
  </div>
</template>
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
<script>
export default {
  data() {
    return {};
  },
};
</script>
