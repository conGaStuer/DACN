<template>
  <Navbar></Navbar>
  <div class="direct">
    <router-link to="/">Home</router-link> <span>></span>
    <router-link to="" :style="{ color: '#f03333' }"
      >Product Detail</router-link
    >
  </div>
  <div class="product-side">
    <div
      class="product-image"
      :style="{ backgroundImage: `url(${product.hinhanh})` }"
    ></div>
    <div class="product-info">
      <div class="product-name">{{ product.tensp }}</div>
      <div class="product-rating">
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star-half-stroke"></i>
        (2810 customer review) | Brand: <span> {{ product.mansx }}</span>
      </div>
      <p class="product-price">$ {{ product.gia }}.00</p>
      <div class="product-spec">
        <p>Sold By: <span>TXK2810</span></p>
        <ul>
          <li>5.0 inch HD Screen</li>
          <li>Android 4.4 KitKat OS</li>
          <li>1.4 GHz Quad Core™ Processor</li>
          <li>20 MP front Camera</li>
        </ul>
      </div>
      <div class="product-handle">
        <button class="add" @click="addtoCart">
          <i class="fa-brands fa-shopify"></i> Add to cart
        </button>

        <button class="buy">Buy Now</button>
      </div>
      <div class="something">
        <p>
          Category: <span> {{ product.maloai }}</span>
        </p>
        <p>Tags: Iphone, Ipad</p>
        <div class="social">
          <i class="fa-brands fa-facebook"></i>
          <i class="fa-brands fa-github"></i>
          <i class="fa-brands fa-pinterest"></i>
          <i class="fa-brands fa-telegram"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="relate-image">
    <div class="middle-banner"></div>
    <div class="left-banner"></div>
    <div class="right-banner"></div>
  </div>
  <p class="rela">Related Products.</p>
  <div class="relate-product">
    <div class="products-item" v-for="pro in products" :key="pro.id">
      <div
        class="item-image"
        :style="{ backgroundImage: `url(${pro.image})` }"
      ></div>
      <span>-20%</span>
      <div class="item-info">
        <div class="rating">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star-half-stroke"></i>
        </div>
        <div class="item-cate">
          {{ pro.cate }}
        </div>
        <div class="item-name">
          {{ pro.name }}
        </div>
        <div class="item-price">$ {{ pro.price }}</div>
      </div>
    </div>
  </div>
  <Footer></Footer>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";
import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";
import pros from "@/constaint/homeData/relateData";
export default {
  components: {
    Navbar,
    Footer,
  },
  setup() {
    const product = ref({});
    const route = useRoute();
    const products = ref([]);
    const isAddedToCart = ref(false);
    const addtoCart = () => {
      const cartItem = {
        masp: product.value.masp,
        tensp: product.value.tensp,
        hinhanh: product.value.hinhanh,
        gia: product.value.gia,
      };

      axios
        .post("http://localhost/dacn/src/api/addToCart.php", cartItem)
        .then((response) => {
          console.log(response.data);

          const promptMessage = "Item added to cart successfully!";
          window.alert(promptMessage);
        })
        .catch((error) => {
          console.error("Error adding to cart:", error);
        });
    };
    onMounted(() => {
      const productId = route.params.id;

      axios
        .get(`http://localhost/dacn/src/api/products.php/${productId}`)
        .then((res) => {
          product.value = res.data;
        })
        .catch((err) => {
          console.log("Error", err);
        });

      products.value = pros;
      console.log(products.value);
    });

    return {
      product,
      products,
      addtoCart,
      isAddedToCart,
    };
  },
};
</script>

<style>
@import "../../scss/product_detail.scss";
</style>
