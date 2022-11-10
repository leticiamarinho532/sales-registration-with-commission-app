import Home from '@/pages/Home.vue';
import RegisterSale from '@/pages/RegisterSale.vue';
import ListSellerSales from '@/pages/ListSellerSales.vue';
import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
  { path: '/', component: Home },
  { path: '/cadastrar-venda', component: RegisterSale },
  { path: '/listar-vendas-vendedor', component: ListSellerSales },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;