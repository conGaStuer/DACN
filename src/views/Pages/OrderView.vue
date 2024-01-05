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
          <th>Total</th>
          <th>Invoice</th>
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
          <td>{{ getOrderStatus(orderDetail.order_status) }}</td>
          <td>{{ calculateTotal(orderDetail) }}</td>
          <td>
            <button @click="printInvoice(orderDetail)">In hóa đơn</button>
          </td>
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
    this.fetchOrderDetails();
  },
  methods: {
    confirmCancelOrder(orderId) {
      const confirmCancel = window.confirm(
        "Are you sure you want to cancel this order?"
      );

      if (confirmCancel) {
        this.cancelOrder(orderId);
      }
    },
    calculateTotal(orderDetail) {
      return orderDetail.soluong * orderDetail.gia;
    },
    printInvoice(orderDetail) {
      const invoiceContent = this.generateInvoiceContent(orderDetail);

      window.open().document.write(`<pre>${invoiceContent}</pre>`);
    },
    generateInvoiceContent(orderDetail) {
      const invoiceText = `
        Invoice for Order ID: ${orderDetail.madh}

        Order Details:
        Product ID: ${orderDetail.masp}
        Quantity: ${orderDetail.soluong}
        Price: ${orderDetail.gia}
        Total: ${orderDetail.soluong * orderDetail.gia}



        Order Status: ${this.getOrderStatus(orderDetail.order_status)}
      `;

      return invoiceText;
    },
    fetchOrderDetails() {
      axios
        .get("http://localhost/dacn/src/api/order.php", {
          params: { orderId: this.selectedOrderId },
        })
        .then((response) => {
          this.orderDetails = response.data;
        })
        .catch((error) => {
          console.error("Error fetching order details:", error);
        });
    },
    getOrderStatus(status) {
      switch (status) {
        case "pending":
          return "Pending";
        case "approved":
          return "Approved";
        case "cancelled":
          return "Cancelled";
        default:
          return "Unknown";
      }
    },
    cancelOrder(orderId) {
      axios
        .post("http://localhost/dacn/src/api/deleteOrder.php", {
          action: "delete",
          orderId,
        })
        .then((response) => {
          console.log(response.data.message);

          this.fetchOrderDetails();
        });
    },
  },
};
</script>

<style>
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
