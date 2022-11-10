import Home from '@/pages/Home.vue';
import RegisterSale from '@/pages/RegisterSale.vue';
import RegisterSeller from '@/pages/RegisterSeller.vue';
import ListSellerSales from '@/pages/ListSellerSales.vue';
import ListSellers from '@/pages/ListSellers.vue';
import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
  { path: '/', component: Home },
  { path: '/cadastrar-venda', component: RegisterSale },
  { path: '/listar-vendas-vendedor', component: ListSellerSales },
  { path: '/cadastrar-vendedor', component: RegisterSeller },
  { path: '/listar-vendedores', component: ListSellers },
];


const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;