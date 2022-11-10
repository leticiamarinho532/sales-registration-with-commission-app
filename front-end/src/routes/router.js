import Home from '@/pages/Home.vue';
import RegisterSale from '@/pages/RegisterSale.vue';
import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
  { path: '/', component: Home },
  { path: '/cadastrar-venda', component: RegisterSale },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;