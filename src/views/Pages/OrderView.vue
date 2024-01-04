<!-- OrderView.vue -->
<template>
  <Navbar></Navbar>
  <div>
    <h2>Order Details</h2>
    <table border="1" class="order-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Product ID</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Image</th>
          <th>Delete</th>
          <th>Order status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="orderDetail in orderDetails" :key="orderDetail.id">
          <td>{{ orderDetail.madh }}</td>
          <td>{{ orderDetail.masp }}</td>
          <td>{{ orderDetail.soluong }}</td>
          <td>{{ orderDetail.gia }}</td>
          <td>
            <img
              :src="orderDetail.hinhanh"
              alt="Product Image"
              style="max-width: 100px; max-height: 100px"
            />
          </td>
          <td>
            <button @click="confirmCancelOrder(orderDetail.madh)">
              Cancel
            </button>
          </td>
          <td>Cho xac nhan</td>
        </tr>
      </tbody>
    </table>
  </div>
  <Footer></Footer>
</template>

<script>
import axios from "axios";
import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";
export default {
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      orderDetails: [],
    };
  },
  mounted() {
    // Gọi API để lấy tất cả chi tiết đơn hàng
    this.fetchOrderDetails();
  },
  methods: {
    // ... (các phương thức khác)
    confirmCancelOrder(orderId) {
      const confirmCancel = window.confirm(
        "Are you sure you want to cancel this order?"
      );

      if (confirmCancel) {
        this.cancelOrder(orderId);
      }
    },
    fetchOrderDetails() {
      // Gọi API hoặc bất kỳ logic nào bạn muốn để lấy chi tiết đơn hàng
      // Ví dụ:
      axios
        .get("http://localhost/dacn/src/api/order.php", {
          params: { orderId: this.selectedOrderId }, // Thay đổi params tùy thuộc vào API của bạn
        })
        .then((response) => {
          this.orderDetails = response.data;
        })
        .catch((error) => {
          console.error("Error fetching order details:", error);
        });
    },
    cancelOrder(orderId) {
      axios
        .post("http://localhost/dacn/src/api/deleteOrder.php", {
          action: "delete",
          orderId,
        })
        .then((response) => {
          console.log(response.data.message);
          // Refresh the order details after canceling the order
          this.fetchOrderDetails(); // Hãy chắc chắn rằng bạn có một phương thức để fetch dữ liệu đơn hàng
        });
    },
  },
};
</script>

<style>
/* Thêm CSS nếu cần */
.order-table {
  width: 100%;
  border-collapse: collapse;

  position: relative;
  top: 150px;
  margin: 0 auto;
}

.order-table th,
.order-table td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: left;
}

.order-table th {
  background-color: #f2f2f2;
}

.order-table tr:hover {
  background-color: #f5f5f5;
}

.product-image {
  max-width: 100px;
  max-height: 100px;
}
</style>
