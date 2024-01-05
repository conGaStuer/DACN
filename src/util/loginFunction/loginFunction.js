import axios from "axios";
import { onMounted, ref } from "vue";
import router from "@/router"; // Import Vue Router

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
      .get("http://localhost/dacn/src/api/api.php")
      .then((res) => {
        users.value = res.data;
        console.log(users.value);
      })
      .catch((err) => console.log(err));
  };

  const registerUser = () => {
    axios
      .post("http://localhost/dacn/src/api/api.php", {
        username: username.value,
        password: password.value,
        action: "register",
      })
      .then((res) => {
        console.log(res.data);
        fetchUser();
        router.push({ name: "home" }); // Redirect to home page after registration
      })
      .catch((error) => {
        console.error(error);
      });
  };

  const loginUser = () => {
    axios
      .post("http://localhost/dacn/src/api/api.php", {
        username: username.value,
        password: password.value,
        action: "login",
      })
      .then((res) => {
        console.log(res.data);
        if (res.data.message === "Login successful.") {
          fetchUser();

          errorLogin.value = "";
          router.push({ name: "home" }); // Redirect to home page after successful login
        } else {
          errorLogin.value = "Invalid username or password.";
        }
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
