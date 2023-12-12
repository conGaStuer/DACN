import axios from "axios";
import { onMounted, ref } from "vue";

const shopFunction = () => {
  const products = ref();
  const fetchProducts = () => {
    axios
      .get("http://localhost/DACN/dacn-vuejs/src/api/products.php")
      .then((res) => {
        products.value = res.data;
        console.log(products.value);
      })
      .catch((err) => {
        console.log("Error fetching data", err);
      });
  };
  onMounted(() => {
    fetchProducts();
  });
  return {
    products,
    fetchProducts,
  };
};
export default shopFunction;
