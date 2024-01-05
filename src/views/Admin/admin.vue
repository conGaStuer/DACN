<template>
  <div>
    <h2>
      {{
        activeTab === "products"
          ? "Product Management"
          : activeTab === "users"
          ? "User Management"
          : "Order Management"
      }}
    </h2>
    <div>
      <button @click="switchTab('products')">Manage Products</button>
      <button @click="switchTab('users')">Manage Users</button>
      <button @click="switchTab('orders')">Manage Orders</button>
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
    <table class="order-table" v-if="activeTab === 'orders'" border="1">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Total Amount</th>
          <th>Customer ID</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.madh">
          <td>{{ order.madh }}</td>
          <td>{{ order.tongtien }}</td>
          <td>{{ order.maKH }}</td>
          <td>
            <button @click="showOrderDetails(order)">View Details</button>
            <button
              @click="approveOrder(order.madh)"
              :disabled="order.order_status !== 'Pending'"
            >
              Approve
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <admin-order-details
      v-if="activeTab === 'orders'"
      :orderDetails="selectedOrderDetails"
    />
  </div>
</template>

<script>
import axios from "axios";
import AdminOrderDetails from "./AdminOrderDetails.vue";
export default {
  components: {
    AdminOrderDetails,
  },
  data() {
    return {
      activeTab: "products",
      products: [],
      users: [],
      orders: [],
      selectedOrderDetails: [],
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
    approveOrder(orderId) {
      axios
        .post("http://localhost/dacn/src/api/approveOrder.php", {
          action: "approve",
          orderId,
        })
        .then((response) => {
          console.log(response.data.message);

          if (response.data.success) {
            const approvedOrderIndex = this.orders.findIndex(
              (order) => order.madh === orderId
            );
            if (approvedOrderIndex !== -1) {
              this.orders[approvedOrderIndex].order_status = "Delivering";
              console.log(`Order ${orderId} status updated to Delivering`);
            } else {
              console.log(`Order ${orderId} not found in orders array`);
            }
          } else {
            console.error("Error approving order:", response.data.error);
          }
        })
        .catch((error) => {
          console.error("Error approving order:", error);
        });
    },

    fetchProducts() {
      axios
        .get("http://localhost/dacn/src/api/adminProduct.php")
        .then((response) => {
          this.products = response.data;
        });
    },
    fetchOrders() {
      axios
        .get("http://localhost/dacn/src/api/adminOrder.php")
        .then((response) => {
          this.orders = response.data.map((order) => ({
            ...order,
            order_status: "Pending",
          }));
        });
    },
    fetchData() {
      if (this.activeTab === "users") {
        axios
          .get("http://localhost/dacn/src/api/manageUser.php")
          .then((response) => {
            this.users = response.data;
          });
      } else if (this.activeTab === "orders") {
        this.fetchOrders();
      } else {
        this.fetchProducts();
      }
    },
    showOrderDetails(order) {
      axios
        .get(
          `http://localhost/dacn/src/api/AdminOrderDetails.php?orderId=${order.madh}`
        )
        .then((response) => {
          this.selectedOrderDetails = response.data;
        });
    },
    fetchProducts() {
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

          this.fetchProducts();
        });
    },

    editProduct(product) {
      const newProductName = prompt("Enter new product name:", product.tensp);
      const newCategoryId = prompt("Enter new category ID:", product.maloai);
      const newImage = prompt("Enter new image URL:", product.hinhanh);
      const newManufacturerId = prompt(
        "Enter new manufacturer ID:",
        product.mansx
      );
      const newPrice = prompt("Enter new price:", product.gia);

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

          this.fetchProducts();
        });
    },
    deleteProduct(productId) {
      const confirmDelete = window.confirm(
        "Are you sure you want to delete this product?"
      );
      if (!confirmDelete) {
        return;
      }

      axios
        .post("http://localhost/dacn/src/api/deleteProduct.php", {
          action: "delete",
          productId,
        })
        .then((response) => {
          console.log(response.data.message);

          this.fetchProducts();
        });
    },
    deleteUser(userId) {
      const confirmDelete = window.confirm(
        "Are you sure you want to delete this user?"
      );
      if (!confirmDelete) {
        return;
      }

      axios
        .post("http://localhost/dacn/src/api/deleteUser.php", {
          action: "delete",
          userId,
        })
        .then((response) => {
          console.log(response.data.message);

          this.fetchData();
        });
    },
  },
};
</script>

<style>
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
