<template>
  <section>
    <div class="login-side">
      <div class="login-image"></div>
      <div class="login-form">
        <div class="login-form--side">
          <div class="login-text">Sign In</div>
          <form
            action=""
            @submit.prevent="loginUser"
            mtheod="post"
            class="form"
          >
            <div class="form-input">
              <input
                type="text"
                name=""
                class="username"
                placeholder="Username"
                v-model="username"
                required
              />
              <input
                type="password"
                name=""
                class="username"
                placeholder="Password"
                v-model="password"
                required
              />
            </div>
            <div v-if="errorLogin">
              {{ errorLogin }}
            </div>
            <input type="checkbox" name="" class="checkbox" />
            <span class="span"> Remember me </span>
            <br />

            <input type="submit" value="Log in" class="login-btn" />
          </form>
          <router-link to="./register">Create an account</router-link>
          <div class="login-social">
            Or login with
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
import userController from "@/util/loginFunction/loginFunction";
export default {
  setup() {
    const { username, password, fetchUser, loginUser, users, errorLogin } =
      userController();

    return {
      username,
      password,
      fetchUser,
      loginUser,
      users,
      errorLogin,
    };
  },
};
</script>

<style>
@import "../../scss/login.scss";
</style>
