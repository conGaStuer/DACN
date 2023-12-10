<template>
  <section>
    <div class="login-side">
      <div class="login-image"></div>
      <div class="login-form">
        <div class="login-form--side">
          <div class="login-text">Sign In</div>
          <form @submit.prevent="registerUser" method="post" class="form">
            <div class="form-input">
              <input
                type="text"
                name=""
                id=""
                class="username"
                placeholder="Username"
                v-model="username"
              />
              <input
                type="password"
                name=""
                id=""
                class="username"
                placeholder="Password"
                v-model="password"
              />
            </div>
            <input type="checkbox" name="" id="" class="checkbox" />
            <span class="span"
              >I agree all statements in Terms of service
            </span>
            <br />

            <input type="submit" value="Sign up" class="login-btn" />
          </form>
          <router-link to="./login">Have an account? </router-link>
          <div class="login-social">
            Or sign up with
            <i class="fa-brands fa-square-facebook"></i>
            <i class="fa-brands fa-square-twitter"></i>
            <i class="fa-brands fa-square-google-plus"></i>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import userController from "@/util/loginFunction/loginFunction.js";
export default {
  setup() {
    const { username, password, fetchUser, registerUser, users } =
      userController();
    return {
      username,
      password,
      fetchUser,
      registerUser,
      users,
    };
  },
};
</script>

<style>
@import "../../scss/login.scss";
</style>
