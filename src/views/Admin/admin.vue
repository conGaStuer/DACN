<template>
  <div>
    <h2>
      {{ activeTab === "products" ? "Product Management" : "User Management" }}
    </h2>
    <div>
      <button @click="switchTab('products')">Manage Products</button>
      <button @click="switchTab('users')">Manage Users</button>
    </div>
    <button v-if="activeTab === 'products'" @click="addNewProduct">
      Add New Item
    </button>
    <table class="product-table" v-if="activeTab === 'products'">
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Category ID</th>
          <th>Image</th>
          <th>Manufacturer ID</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.masp">
          <td>{{ product.masp }}</td>
          <td>{{ product.tensp }}</td>
          <td>{{ product.maloai }}</td>
          <td>{{ product.hinhanh }}</td>
          <td>{{ product.mansx }}</td>
          <td>{{ product.gia }}</td>
          <td>
            <button @click="editProduct(product)">Edit</button>
            <button @click="deleteProduct(product.masp)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="user-table" v-if="activeTab === 'users'">
      <thead>
        <tr>
          <th>User ID</th>
          <th>User Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>Password</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.maKH">
          <td>{{ user.maKH }}</td>
          <td>{{ user.tenkh }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.username }}</td>
          <td>{{ user.password }}</td>
          <td>
            <button @click="deleteUser(user.maKH)">Delete User</button>
          </td>
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
      activeTab: "products",
      products: [],
      users: [],
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    switchTab(tab) {
      this.activeTab = tab;
      this.fetchData();
    },

    fetchData() {
      if (this.activeTab === "users") {
        // Make a GET request to manageUsers.php to fetch users
        axios
          .get("http://localhost/dacn/src/api/manageUser.php")
          .then((response) => {
            this.users = response.data;
          });
      } else {
        // Make a GET request to adminProduct.php to fetch products
        this.fetchProducts();
      }
    },

    fetchProducts() {
      // Make a GET request to the adminProduct.php file to fetch products
      axios
        .get("http://localhost/dacn/src/api/adminProduct.php")
        .then((response) => {
          this.products = response.data;
        });
    },

    addNewProduct() {
      const productName = prompt("Enter product name:");
      const categoryId = prompt("Enter category ID:");
      const image = prompt("Enter image URL:");
      const manufacturerId = prompt("Enter manufacturer ID:");
      const price = prompt("Enter price:");

      // Make a POST request to addProduct.php with the new product information
      axios
        .post("http://localhost/dacn/src/api/addProduct.php", {
          action: "add",
          productName,
          categoryId,
          image,
          manufacturerId,
          price,
        })
        .then((response) => {
          console.log(response.data.message);

          // Refresh the product list after adding a new product
          this.fetchProducts();
        });
    },

    editProduct(product) {
      // Implement the logic for editing a product
      const newProductName = prompt("Enter new product name:", product.tensp);
      const newCategoryId = prompt("Enter new category ID:", product.maloai);
      const newImage = prompt("Enter new image URL:", product.hinhanh);
      const newManufacturerId = prompt(
        "Enter new manufacturer ID:",
        product.mansx
      );
      const newPrice = prompt("Enter new price:", product.gia);

      // Make a POST request to editProduct.php with the updated information
      axios
        .post("http://localhost/dacn/src/api/editProduct.php", {
          action: "edit",
          productId: product.masp,
          newProductName,
          newCategoryId,
          newImage,
          newManufacturerId,
          newPrice,
        })
        .then((response) => {
          console.log(response.data.message);

          // Refresh the product list after editing
          this.fetchProducts();
        });
    },
    deleteProduct(productId) {
      // Confirm with the user before deleting the product
      const confirmDelete = window.confirm(
        "Are you sure you want to delete this product?"
      );
      if (!confirmDelete) {
        return;
      }

      // Make a POST request to delete.php with the product ID
      axios
        .post("http://localhost/dacn/src/api/deleteProduct.php", {
          action: "delete",
          productId,
        })
        .then((response) => {
          console.log(response.data.message);

          // Refresh the product list after deleting the product
          this.fetchProducts();
        });
    },
    deleteUser(userId) {
      // Confirm with the user before deleting
      const confirmDelete = window.confirm(
        "Are you sure you want to delete this user?"
      );
      if (!confirmDelete) {
        return;
      }

      // Make a POST request to deleteUser.php with the user ID
      axios
        .post("http://localhost/dacn/src/api/deleteUser.php", {
          action: "delete",
          userId,
        })
        .then((response) => {
          console.log(response.data.message);

          // Refresh the user list after deleting the user
          this.fetchData();
        });
    },
  },
};
</script>

<style>
/* Add your CSS styles here */
.product-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.product-table th,
.product-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.product-table th {
  background-color: #f2f2f2;
}

.product-table tr:hover {
  background-color: #f5f5f5;
}

.product-table button {
  cursor: pointer;
  padding: 5px 10px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
}

.product-table button:hover {
  background-color: #45a049;
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
