import axios from "axios";
import { onMounted, ref } from "vue";

import router from "@/router";
const userController = () => {
  const username = ref("");
  const password = ref("");
  const users = ref([]);
  const errorLogin = ref("");
  onMounted(() => {
    fetchUser();
  });

  const fetchUser = () => {
    axios
      .get("http://localhost/DACN/dacn-vuejs/src/api/api.php")
      .then((res) => {
        users.value = res.data;
        console.log(users.value);
      })
      .catch((err) => console.log(err));
  };

  const registerUser = () => {
    axios
      .post("http://localhost/DACN/dacn-vuejs/src/api/api.php", {
        username: username.value,
        password: password.value,
        action: "register",
      })
      .then((res) => {
        console.log(res.data);
        fetchUser();
        router.push({ name: "home" });
      })
      .catch((error) => {
        console.error(error);
      });
  };
  const loginUser = () => {
    axios
      .post("http://localhost/DACN/dacn-vuejs/src/api/api.php", {
        username: username.value,
        password: password.value,
        action: "login",
      })
      .then((res) => {
        console.log(res.data);
        if (res.data.message === "Login successful.") {
          fetchUser();
          // Clear login error on successful login
          errorLogin.value = "";
          router.push({ name: "home" });
        } else {
          // Set login error message
          errorLogin.value = "Invalid username or password.";
        } //
      })
      .catch((error) => {
        console.error(error);
        errorLogin.value = "Invalid username or password";
      });
  };

  return {
    username,
    password,
    fetchUser,
    registerUser,
    users,
    loginUser,
    errorLogin,
  };
};
export default userController;
