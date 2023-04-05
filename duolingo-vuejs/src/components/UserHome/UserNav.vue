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
    <nav id="side-bar">
      <div>
        <RouterLink to="/user-home/learn"><img id="logo-duolingo" src="https://d35aaqx5ub95lt.cloudfront.net/vendor/70a4be81077a8037698067f583816ff9.svg" alt="logo-duolingo"></RouterLink>
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
              <!-- <img id="img" :src="'data:image/jpeg;base64,' + user.avatar"/> -->
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

<style scoped>

#side-bar {
  min-height: 100vh;
  border-right: 2px solid rgb(212, 212, 212);
  width: max-content;
  display: flex;
}

#side-bar #logo-duolingo {
  padding: 20px;
  margin: 20px 0px 0px 46px;
  height: 80px;
}

#navigation ul .nav-list {
  list-style: none;
  display: flex;
  padding: 12px 28px;
  margin: 10px 20px 10px 0px;
  border-radius: 12px;
}

#navigation ul .nav-list:hover,
#logo-duolingo {
  cursor: pointer;
}

#navigation ul .nav-list:hover {
  background-color: #e3e3e3;
}

#navigation ul .nav-list img {
  height: 30px;
  width: 30px;
  margin-right: 12px;
}

#navigation ul .nav-list p {
  color: #777777;
  font-weight: bold;
  align-self: center;
}

#navigation ul .nav-list ul {
  position: absolute;
  list-style: none;
  border: 2px #b1b1b1 solid;
  border-radius: 12px;
  padding: 20px;
  left: 200px;
  width: max-content;
  background-color: white;
  width: 280px;
}

#navigation ul .nav-list ul div {
  display: flex;
  align-items: center;
  margin-bottom: 12px;
  padding-bottom: 10px;
  border-bottom: 2px solid #b1b1b1;
}

#navigation ul .nav-list ul div span {
  font-weight: bolder;
  color: #777777;
  padding: 0px 12px;
}

#navigation ul .nav-list ul li {
  color: #777777;
  font-weight: bolder;
  padding: 4px 10px;

}

#navigation ul .nav-list ul li:hover {
  background-color: #e6e6e6;
  border-radius: 12px;
}
</style>
