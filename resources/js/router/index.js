import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes.js'
import store from '../store'

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  /**
   * Check if logged in user accessing guest link
   */
  if (store.getters.user) {
    if (to.matched.some(route => route.meta.guard === 'guest')) next({ name: 'products' })
    else next();
  } 
  /**
     * Check if guest users accessing login user links
     */
  else {
    if (to.matched.some(route => route.meta.guard === 'auth')) next({ name: 'login' })
    else next();
  }
})

export default router;

