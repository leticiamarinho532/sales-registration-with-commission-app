import Home from '@/pages/Home.vue';
import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
  { path: '/', component: Home },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;