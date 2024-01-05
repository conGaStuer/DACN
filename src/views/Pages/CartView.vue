<template>
  <Navbar />
  <div class="direct">
    <router-link to="/">Home</router-link> <span>></span>
    <router-link to="/shop" :style="{ color: '#f03333' }">Shop</router-link>
  </div>
  <div class="banner"></div>
  <div>
    <h2>Your Shopping Cart</h2>
    <h4>
      <router-link to="/order">Order Status</router-link>
    </h4>
    <table class="cart-table">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Image</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in cartItems" :key="item.masp">
          <td>{{ item.tensp }}</td>
          <td>
            <img
              :src="item.hinhanh"
              alt="Product Image"
              style="width: 50px; height: 50px"
            />
          </td>
          <td>$ {{ item.gia }}</td>
          <td>
            <button @click="decrementQuantity(item)">-</button>
            {{ item.soluong }}
            <button @click="incrementQuantity(item)">+</button>
          </td>
          <td>$ {{ item.gia * item.soluong }}</td>
          <td>
            <button @click="deleteItem(item)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Add this button in your template -->
    <button @click="checkout">Checkout</button>
  </div>
  <Footer></Footer>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";
export default {
  components: {
    Navbar,
    Footer,
  },
  setup() {
    const cartItems = ref([]);

    const fetchCartItems = () => {
      axios
        .get("http://localhost/dacn/src/api/cart.php")
        .then((response) => {
          cartItems.value = response.data;
        })
        .catch((error) => {
          console.error("Error fetching cart items:", error);
        });
    };
    const incrementQuantity = (item) => {
      updateQuantity(item, item.soluong + 1);
    };

    const decrementQuantity = (item) => {
      if (item.soluong > 1) {
        updateQuantity(item, item.soluong - 1);
      }
    };

    const deleteItem = (item) => {
      axios
        .post("http://localhost/dacn/src/api/deleteCart.php", {
          masp: item.masp,
        })
        .then((response) => {
          if (response.data.message === "Item deleted successfully.") {
            const index = cartItems.value.findIndex(
              (cartItem) => cartItem.masp === item.masp
            );
            if (index !== -1) {
              cartItems.value.splice(index, 1);
            }
          }
        })
        .catch((error) => {
          console.error("Error deleting item:", error);
        });
    };
    const updateQuantity = (item, newQuantity) => {
      axios
        .post("http://localhost/dacn/src/api/editQuantity.php", {
          masp: item.masp,
          soluong: newQuantity,
        })
        .then((response) => {
          if (response.data.message === "Quantity updated successfully.") {
            item.soluong = newQuantity;
          }
        })
        .catch((error) => {
          console.error("Error updating quantity:", error);
        });
    };
    const checkout = () => {
      const cartItemsToSend = cartItems.value.map((item) => {
        return {
          masp: item.masp,
          tensp: item.tensp,
          maloai: item.maloai,
          gia: item.gia,
          soluong: item.soluong,
          hinhanh: item.hinhanh,
        };
      });

      axios
        .post("http://localhost/dacn/src/api/createOrder.php", {
          cartItems: cartItemsToSend,
        })
        .then((response) => {
          console.log("Server response:", response.data);
          if (response.data.message === "Order placed successfully") {
            window.location.href = "/order";
          } else {
            console.error("Error placing the order");
          }
        })
        .catch((error) => {
          console.error("Error:", error.message);
        });
    };

    onMounted(() => {
      fetchCartItems();
    });

    return {
      cartItems,
      incrementQuantity,
      deleteItem,
      decrementQuantity,
      checkout,
    };
  },
};
</script>

<style>
h2 {
  position: relative;
  top: 100px;
}
.cart-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 150px;
}

.cart-table th,
.cart-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.cart-table th {
  background-color: #f2f2f2;
}
</style>
