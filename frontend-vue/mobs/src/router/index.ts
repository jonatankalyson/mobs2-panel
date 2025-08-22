import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import VehiclesView from '../views/VehiclesView.vue'
import RegisterView from '../views/RegisterView.vue'
import formView from '../views/formView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/login',
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/vehicles',
      name: 'vehicles',
      component: VehiclesView,
    },
    {
      path: '/register', 
      name: 'register',
      component: RegisterView,
    },
    {
      path: '/form', 
      name: 'form',
      component: formView,
    },
  ],
})

export default router
