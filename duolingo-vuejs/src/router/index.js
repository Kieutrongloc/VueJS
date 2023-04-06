import { createRouter, createWebHistory } from 'vue-router'
// import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../components/HomePage.vue')
    },
    {
      path: '/user-home/course/:course_id',
      name: 'course',
      component: () => import('../components/Course/Course.vue')
    },
    {
      path: '/user-home/game/:skill_id',
      name: 'game',
      component: () => import('../components/Game/Game.vue')
    },
    {
      path: '/user-home',
      name: 'user-home',
      component: () => import('../components/UserHome.vue'),
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
      path: '/lesson/:lesson_id',
      name: 'lesson',
      component: () => import('../components/Lesson/Lesson.vue')
    },

  ]
})

export default router
