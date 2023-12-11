<template>
  <Navbar />
  <div class="direct">
    <router-link to="/">Home</router-link> <span>></span>
    <router-link to="/about" :style="{ color: '#f03333' }">About</router-link>
  </div>
  <div class="about-intro--text">
    <p>Empowering eCommerce</p>
    <h4>brands everywhere.</h4>
    <h5>
      Learn more about our story and the hard-working
      <br />
      people behind the pink envelope.
    </h5>
  </div>
  <div class="about-video">
    <video autoplay muted loop>
      <source src="../../assets/intro.mp4" type="video/mp4" />
    </video>
  </div>
  <div class="about-intro--text2">
    <span>
      To empower digital retailers to automate and personalize their customer
      communications by leveraging deep-data and behavioral-based marketing
      automation.
    </span>
  </div>
  <div class="service">
    <div class="service-container">
      <div class="service-item">
        <i class="fa-brands fa-btc"></i>
        <h5>Selfless</h5>
        <span
          >Fusce vel dui. Sed augue ipsum, eges <br />
          vestibulum, malesuada adipiscing</span
        >
      </div>
      <div class="service-item">
        <i class="fa-solid fa-gears"></i>
        <h5>Communication</h5>
        <span
          >Fusce vel dui. Sed augue ipsum, eges <br />
          vestibulum, malesuada adipiscing</span
        >
      </div>
      <div class="service-item">
        <i class="fa-solid fa-comments-dollar"></i>
        <h5>Deliver Results</h5>
        <span
          >Fusce vel dui. Sed augue ipsum, eges <br />
          vestibulum, malesuada adipiscing</span
        >
      </div>
    </div>
  </div>
  <div class="personnel">
    <span>Our Teams</span>
    <div class="personnel-container">
      <div
        class="personnel-item"
        v-on:mouseenter="showInfo"
        v-on:mouseleave="hideInfo"
      >
        <img
          src="https://wpbingosite.com/wordpress/digic/wp-content/webp-express/webp-images/uploads/2019/06/ourteam-1.jpg.webp"
          alt=""
        />
        <h4>Tran Xuan</h4>
        <h5>CEO</h5>
        <transition name="slide">
          <div class="personnel-info" v-if="isInfo">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-solid fa-circle-down"></i>
            <i class="fa-brands fa-gg-circle"></i>
            <i class="fa-brands fa-google-plus"></i>
          </div>
        </transition>
      </div>
      <div class="personnel-item">
        <img
          src="https://wpbingosite.com/wordpress/digic/wp-content/webp-express/webp-images/uploads/2019/06/ourteam-2.jpg.webp"
          alt=""
        />
        <h4>Tran Xuan Khuong</h4>
        <h5>Designer</h5>
      </div>
      <div class="personnel-item">
        <img
          src="https://wpbingosite.com/wordpress/digic/wp-content/webp-express/webp-images/uploads/2016/08/ourteam-3.jpg.webp"
          alt=""
        />
        <h4>Tran Xuan</h4>
        <h5>Dev</h5>
      </div>
    </div>
  </div>
  <div class="question">
    <div class="question-image"></div>
    <div class="question-list">
      <p>What can we do for you ?</p>
      <div class="list">
        <i class="fa-solid fa-circle"></i>
        <div class="list-text">
          <h5>Best Quality</h5>
          <span
            >Phasellus accumsan cursus velit. Sed aliquam ultrices mauris.
            Integer ante arcu, accumsan</span
          >
        </div>
      </div>
      <div class="list">
        <i class="fa-solid fa-circle"></i>
        <div class="list-text">
          <h5>Best Quality</h5>
          <span
            >Phasellus accumsan cursus velit. Sed aliquam ultrices mauris.
            Integer ante arcu, accumsan</span
          >
        </div>
      </div>
      <div class="list">
        <i class="fa-solid fa-circle"></i>
        <div class="list-text">
          <h5>Best Quality</h5>
          <span
            >Phasellus accumsan cursus velit. Sed aliquam ultrices mauris.
            Integer ante arcu, accumsan</span
          >
        </div>
      </div>
    </div>
  </div>
  <Footer></Footer>
</template>
<script>
import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";
import { ref } from "vue";
export default {
  components: { Navbar, Footer },
  setup() {
    const isInfo = ref(false);

    const showInfo = () => {
      isInfo.value = true;
    };

    const hideInfo = () => {
      isInfo.value = false;
    };
    return {
      isInfo,
      showInfo,
      hideInfo,
    };
  },
};
</script>
<style lang="scss">
@import "../../scss/about.scss";
.slide-enter-active,
.slide-leave-active {
  transition: height 0.5s ease-in;
}
.slide-enter,
.slide-leave-to {
  height: 0;
}
.slide-enter-to,
.slide-leave {
  height: 100px;
}
</style>
