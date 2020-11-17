import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/Home.vue";
import Imovel from "../views/Imovel.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/imovel",
    name: "Imovel",
    component: Imovel,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;