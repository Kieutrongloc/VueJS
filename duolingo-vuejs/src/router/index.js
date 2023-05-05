import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../components/HomePage.vue')
    },
    {
      path: '/sign-in',
      name: 'sign-in',
      component: () => import('../components/SignIn.vue')
    },
    {
      path: '/sign-up',
      name: 'sign-up',
      component: () => import('../components/SignUp.vue')
    },
    {
      path: '/user-home/:switch_body/',
      name: 'user-home',
      component: () => import('../components/UserHome.vue'),
    },
    {
      path: '/user-home/:switch_body/:switch_setting',
      name: 'user-setting',
      component: () => import('../components/UserHome.vue'),
    },
    {
      path: '/skill/:lesson_id/:skill_id',
      name: 'skill',
      component: () => import('../components/Skill/Skill.vue')
    },
    {
      path: '/:catchAll(.*)',
      name: 'not-found',
      component: () => import('../components/NotFound.vue')
    },
  ]
})

export default router
