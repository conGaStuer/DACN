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
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Pages/AboutView.vue"),
  },
  {
    path: "/contact",
    name: "contact",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Pages/ContactView.vue"),
  },
  {
    path: "/shop",
    name: "shop",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Pages/ShopView.vue"),
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
