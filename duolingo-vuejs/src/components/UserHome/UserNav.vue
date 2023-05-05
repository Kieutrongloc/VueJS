<script>
import { RouterLink, RouterView } from 'vue-router'
import router from '../../router'
export default {
  name: 'UserNav',
  data() {
    return {
      isShowNavMore: false,
      userData : localStorage.getItem('user'),
      navList : [
        {id: 1, title: 'LEARN', link: '/user-home/learn', img: 'https://d35aaqx5ub95lt.cloudfront.net/vendor/784035717e2ff1d448c0f6cc4efc89fb.svg', alt: 'home'},
        {id: 2, title: 'LEADERBOARD', link: '/user-home/leaderboard', img: 'https://d35aaqx5ub95lt.cloudfront.net/vendor/ca9178510134b4b0893dbac30b6670aa.svg', alt: 'leaderboard'},
        {id: 3, title: 'SHOP', link: '/user-home/shop', img: 'https://d35aaqx5ub95lt.cloudfront.net/vendor/0e58a94dda219766d98c7796b910beee.svg', alt: 'shop'},
        {id: 4, title: 'PROFILE', link: '/user-home/profile', img: JSON.parse(localStorage.getItem('user')).avatar === '' ? '/src/assets/img/addition/default-avatar.png' : JSON.parse(localStorage.getItem('user')).avatar, alt: 'profile'},
      ],
      isSelectedNav : null
    }
  },
  methods: {
    isShowNavMoreHandle() {
      return this.isShowNavMore = true
    },

    isHideNavMoreHandle() {
      return this.isShowNavMore = false
    },

    logoutHandle() {
      localStorage.clear();
      router.push('/')
    },

    selectNavHandle(id) {
      this.isSelectedNav = id
    }
  },
  created() {
    if (!JSON.parse(localStorage.getItem("user"))) {
      router.push('/')
    }
  },
}

</script>



<template setup>
  <nav id="user-nav">
    <div id="user-nav-container">
      <RouterLink to="/user-home/learn"><img id="logo-duolingo" src="https://d35aaqx5ub95lt.cloudfront.net/vendor/70a4be81077a8037698067f583816ff9.svg" alt="logo-duolingo"></RouterLink>
      <div id="navigation">
        <ul>

          <li @click="selectNavHandle(item.id)" :class="['nav-list', isSelectedNav === item.id ? 'selected-nav' : '']" v-for="item in navList" :key="item.id">
            <RouterLink class="nav-list-router" :to="item.link">
              <img :src="item.img" alt="home">
              <p>{{ item.title }}</p>
            </RouterLink>
          </li>

          <li @mouseover="isShowNavMoreHandle" @mouseleave="isHideNavMoreHandle" @click="selectNavHandle(5)" :class="['nav-list', isSelectedNav === 5 ? 'selected-nav' : '']" id="li-show-more">
            <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/7159c0b5d4250a5aea4f396d53f17f0c.svg" alt="more">
            <p id="nav-more">MORE</p>
            <ul v-if="isShowNavMore" id="show-more">
              <div>
                <img src="https://cdn1.iconfinder.com/data/icons/color-flat/4/12-512.png" alt="globe">
                <span>SCHOOLS</span>
              </div>
              <li>SETTINGS</li>
              <li>HELP</li>
              <li @click="logoutHandle">LOGOUT</li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
