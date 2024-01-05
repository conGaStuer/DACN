<template>
  <nav>
    <div class="nav-side">
      <div class="logo">IFLASE.</div>
      <div class="nav-pages">
        <router-link to="/"> HOME </router-link>
        <router-link to="/shop"> SHOP </router-link>
        <router-link to="/about"> ABOUT </router-link>
        <router-link to="/contact"> CONTACT </router-link>
      </div>

      <ul>
        <li>
          <router-link v-if="!loggedUser" to="/login"> Login </router-link>
          <span v-else @click="logout"> Logout </span>
        </li>
        <li><i class="fa-solid fa-magnifying-glass"></i></li>
        <li>
          <i class="fa-regular fa-user"></i>
        </li>

        <li>
          <router-link to="/cart"
            ><i class="fa-solid fa-cart-shopping"></i
          ></router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";
import router from "@/router";

export default {
  setup() {
    const loggedUser = ref(null);

    const checkLogin = () => {
      axios
        .get("http://localhost/dacn/src/api/checkLogin.php")
        .then((res) => {
          loggedUser.value = res.data.user;
        })
        .catch((err) => console.error(err));
    };

    const logout = () => {
      axios
        .post("http://localhost/dacn/src/api/logout.php")
        .then((res) => {
          if (res.data.message === "Logout successful") {
            loggedUser.value = null;

            router.push({ name: "login" });
          }
        })
        .catch((err) => console.error(err));
    };

    onMounted(() => {
      checkLogin();
    });

    return {
      loggedUser,
      checkLogin,
      logout,
    };
  },
};
</script>

<style lang="scss">
@import "../../scss/navbar.scss";
</style>
