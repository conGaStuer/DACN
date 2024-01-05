import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/Pages/HomeView.vue";
import {} from "@/util/loginFunction/loginFunction";
const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
    props: {},
  },
  {
    path: "/about",
    name: "about",

    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Pages/AboutView.vue"),
  },
  {
    path: "/contact",
    name: "contact",

    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Pages/ContactView.vue"),
  },
  {
    path: "/shop",
    name: "shop",

    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Pages/ShopView.vue"),
  },
  {
    path: "/cart",
    name: "cart",

    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Pages/CartView.vue"),
  },
  {
    path: "/order",
    name: "order",

    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Pages/OrderView.vue"),
  },
  {
    path: "/admin",
    name: "admin",

    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Admin/admin.vue"),
  },
  {
    path: "/product/:id",
    name: "productDetail",

    component: () => import("../views/Pages/ProductDetail.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () => import("../views/Login/LoginView.vue"),
    props: {},
  },
  {
    path: "/register",
    name: "register",
    component: () => import("../views/Login/RegisterView.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
