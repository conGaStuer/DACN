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
        <li><i class="fa-solid fa-magnifying-glass"></i></li>
        <li @click="showUser">
          <i class="fa-regular fa-user"></i>
        </li>
        <li><i class="fa-solid fa-cart-shopping"></i></li>
      </ul>
    </div>
  </nav>
  <div class="test" v-if="userr">
    <div>Hello,</div>
    <div>My accout</div>
    <div>Log out</div>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";
export default {
  setup() {
    const userr = ref(false);
    const loggedUser = ref(null);
    const showUser = () => {
      userr.value = !userr.value;
    };
    // const checkLogin = () => {
    //   axios
    //     .get("http://localhost/DACN/dacn-vuejs/src/api/checkLogin.php")
    //     .then((res) => {
    //       loggedUser.value = res.data.user;
    //       console.log(res.data);
    //     })
    //     .catch((err) => console.error(err));
    // };
    // onMounted(() => {
    //   checkLogin();
    // });
    return {
      userr,
      showUser,
      loggedUser,
      // checkLogin,
    };
  },
};
</script>

<style lang="scss">
@import "../../scss/navbar.scss";
</style>
