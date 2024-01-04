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
        </tr>
      </thead>
      <tbody>
        <tr v-for="detail in orderDetails" :key="detail.masp">
          <td>{{ detail.masp }}</td>
          <td>{{ detail.tensp }}</td>
          <td>{{ detail.soluong }}</td>
          <td>{{ detail.gia }}</td>
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
};
</script>

<style>
/* ... (styles for order details) ... */
</style>
