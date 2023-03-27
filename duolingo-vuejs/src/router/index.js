import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/user-home/learn',
      name: 'user-home',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/UserHome.vue'),
      children: [
        {
          path: '/user-home/learn',
          name: 'learn',
          component: () => import('../components/UserHome/UserLearn.vue')
        },
      ]
    },
    {
      path: '/sign-in',
      name: 'sign-in',
      component: () => import('../views/SignIn.vue')
    },
    {
      path: '/sign-up',
      name: 'sign-up',
      component: () => import('../views/SignUp.vue')
    },
    {
      path: '/lesson',
      name: 'first-lesson',
      component: () => import('../components/Lesson/FirstLesson.vue')
    },

  ]
})

export default router
