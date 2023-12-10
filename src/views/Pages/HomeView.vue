<template>
  <navbar></navbar>
  <section class="section-1">
    <img src="../../assets/back1.png" alt="" />
    <div class="introduce-1">
      <p>IPHONE 15 SERIES</p>
      <span class="span-1">Heavy</span>
      <br />
      <span>on features.</span>
      <h5>From $152/mo. or $889 before trade</h5>

      <button>SHOP NOW</button>
    </div>
  </section>
  <section class="section-2">
    <div class="section-2__1">
      <div class="introduce-2">
        <p>2023 BETSSELLER PRODUCTS</p>
        <h5>Apple Smartphone</h5>
        <button>SHOP NOW</button>
      </div>
    </div>
    <div class="section-2__2">
      <div class="introduce-3">
        <p>Accessories</p>
        <h5>Buy 1 get 1 free. Limited time.Hungry up !</h5>
        <button>SHOP NOW</button>
      </div>
    </div>
  </section>
  <section class="section-3">
    <p>TOP SMARTPHONES.</p>
    <vueper-slides
      class="no-shadow"
      :visible-slides="5"
      slide-multiple
      :slide-ratio="1 / 5"
      :gap="5"
      :arrows-outside="false"
    >
      <vueper-slide v-for="(cate, i) in cates" :key="i">
        <template #content>
          <div class="cate">
            <div
              :style="{ backgroundImage: `url(${cate.image})` }"
              class="cate-image"
            ></div>
            <p>{{ cate.text }}</p>
          </div>
        </template>
      </vueper-slide>
    </vueper-slides>
  </section>
  <section class="section-4">
    <div class="grid-container">
      <div class="item" v-for="display in displayItem" :key="display.id">
        <div
          class="item-image"
          :style="{ backgroundImage: `url(${display.image})` }"
        ></div>
        <div class="item-info">
          <div class="item-cate">{{ display.cate }}</div>
          <div class="item-series">{{ display.name }}</div>
          <div class="item-price">{{ display.price }}</div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-7">
    <div class="brand-container">
      <div
        class="brand"
        v-for="brand in brands"
        :key="brand.id"
        :style="{ backgroundImage: `url(${brand.image})` }"
      ></div>
    </div>
  </section>
  <section class="section-5">
    <div class="section-2__1">
      <div class="introduce-2">
        <p>SALE UP TO 20%</p>
        <h5>Apple Smartphone</h5>
        <button>SHOP NOW</button>
      </div>
    </div>
    <div class="section-2__2">
      <div class="introduce-3">
        <p>TOP SELLER OF MONTH</p>
        <h5>Buy 1 get 1 free. Limited time.Hungry up !</h5>
        <button>SHOP NOW</button>
      </div>
    </div>
  </section>
  <section class="section-6">
    <input type="text" placeholder="Your email address" class="subcribe" />
    <button>SUBCRIBE</button>
    <p><i class="fa-solid fa-envelope"></i>CONTACT NOW</p>
  </section>
  <Footer></Footer>
</template>

<script>
import Navbar from "../../views/Pages/Navbar.vue";
import data from "../../constaint/homeData/catedata";
import displayData from "@/constaint/homeData/displaydata";
import brand from "@/constaint/homeData/brand";
import Footer from "../../views/Pages/Footer.vue";
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
import { onMounted, ref } from "vue";
export default {
  props: {},
  name: "HomeView",
  components: { Navbar, VueperSlides, VueperSlide, Footer },
  setup() {
    const cates = ref("");
    const displayItem = ref("");
    const brands = ref("");
    onMounted(() => {
      cates.value = data;
      displayItem.value = displayData;
      brands.value = brand;
    });
    return {
      cates,
      displayItem,
      brands,
    };
  },
};
</script>
<style lang="scss">
@import "../../scss/home.scss";
</style>
