<template>
  <p>
    {{ product.tensp }}
  </p>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";
export default {
  setup() {
    const product = ref({});
    const route = useRoute();
    onMounted(() => {
      const productId = route.params.id;

      axios
        .get(
          `http://localhost/DACN/dacn-vuejs/src/api/products.php/${productId}`
        )
        .then((res) => {
          product.value = res.data;
        })
        .catch((err) => {
          console.log("Error", err);
        });
    });
    return {
      product,
    };
  },
};
</script>

<style></style>
