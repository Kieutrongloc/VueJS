<script>
import { RouterLink, RouterView } from 'vue-router'
import router from '../../router'
export default {
  name: 'UserNav',
  data() {
    return {
      isShowNavMore: false,
      userData : localStorage.getItem('user')
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
  <!-- <div id='container'> -->
    <nav id="user-nav">
      <div id="user-nav-container">
        <RouterLink to="/user-home"><img id="logo-duolingo" src="https://d35aaqx5ub95lt.cloudfront.net/vendor/70a4be81077a8037698067f583816ff9.svg" alt="logo-duolingo"></RouterLink>
        <div id="navigation">
          <ul>
            <li class="nav-list">
              <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/784035717e2ff1d448c0f6cc4efc89fb.svg" alt="home">
              <p>LEARN</p>
            </li>
            <li class="nav-list">
              <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/ca9178510134b4b0893dbac30b6670aa.svg" alt="leaderboard">
              <p>LEADERBOARD</p>
            </li>
            <li class="nav-list">
              <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/0e58a94dda219766d98c7796b910beee.svg" alt="shop">
              <p>SHOP</p>
            </li>
            <li class="nav-list">
              <!-- <img id="img" :src="'data:image/jpeg;base64,' + (JSON.parse(localStorage.getItem('user'))).avatar"/> -->
              <img src="" alt="error">
              <p>PROFILE</p>
            </li>
            <li @mouseover="isShowNavMoreHandle" @mouseleave="isHideNavMoreHandle" class="nav-list">
              <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/7159c0b5d4250a5aea4f396d53f17f0c.svg" alt="more">
              <p id="nav-more">MORE</p>
              <ul v-if="isShowNavMore">
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
  <!-- </div> -->
  <RouterView />
</template>
