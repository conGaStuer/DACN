<!-- UserView.vue -->
<template>
  <div>
    <h2>User Information</h2>
    <table border="1" class="user-table">
      <thead>
        <tr>
          <th>User ID</th>
          <th>User Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>Password</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ user.maKH }}</td>
          <td>{{ user.tenkh }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.username }}</td>
          <td>{{ user.password }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      user: {},
    };
  },
  mounted() {
    // Gọi hàm để lấy thông tin người dùng khi component được mount
    this.fetchUserData();
  },
  methods: {
    fetchUserData() {
      // Gửi request đến server để lấy thông tin người dùng
      axios
        .get("http://localhost/dacn/src/api/user.php")
        .then((response) => {
          this.user = response.data;
        })
        .catch((error) => {
          console.error("Error fetching user data:", error);
        });
    },
  },
};
</script>

<style>
h2 {
  margin-top: 20px;
}
.user-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.user-table th,
.user-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.user-table th {
  background-color: #f2f2f2;
}

.user-table tr:hover {
  background-color: #f5f5f5;
}
</style>
