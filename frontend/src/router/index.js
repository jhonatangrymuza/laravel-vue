import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/Home.vue";
import Imovel from "../views/Imovel.vue";
import ContratoImovel from "../views/ContratoImovel";

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
  {
    path: "/ContratoImovel",
    name: "Contratar Imovel",
    component: ContratoImovel,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;