<template>
  <div>
    <h2>Order Details</h2>
    <table class="order-details-table" border="1">
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="detail in orderDetails" :key="detail.masp">
          <td>{{ detail.masp }}</td>
          <td>{{ detail.tensp }}</td>
          <td>{{ detail.soluong }}</td>
          <td>{{ detail.gia }}</td>
          <td>
            <img
              :src="detail.hinhanh"
              alt="Product Image"
              style="max-width: 100px; max-height: 100px"
            />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    orderDetails: {
      type: Array,
      default: () => [],
    },
  },
  methods: {
    approveOrder(orderId) {
      const confirmApprove = window.confirm(
        "Are you sure you want to approve this order?"
      );
      if (!confirmApprove) {
        return;
      }

      axios
        .post("http://localhost/dacn/src/api/approveOrder.php", {
          action: "approve",
          orderId,
        })
        .then((response) => {
          console.log(response.data.message);

          this.fetchOrders();
        });
    },
  },
};
</script>

<style></style>
