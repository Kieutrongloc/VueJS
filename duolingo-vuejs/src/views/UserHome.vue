<script setup>
import { RouterLink, RouterView } from 'vue-router'
import UserLearn from '../components/UserHome/UserLearn.vue'

</script>



<template setup>
  <!-- <div id='container'> -->
    <nav id="side-bar">
      <div>
        <RouterLink to="/user-home/learn"><img id="logo-duolingo" src="https://d35aaqx5ub95lt.cloudfront.net/vendor/70a4be81077a8037698067f583816ff9.svg" alt="logo-duolingo"></RouterLink>
        <div id="navigation">
          <ul>
            <li>
              <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/784035717e2ff1d448c0f6cc4efc89fb.svg" alt="home">
              <p>LEARN</p>
            </li>
            <li>
              <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/ca9178510134b4b0893dbac30b6670aa.svg" alt="leaderboard">
              <p>LEADERBOARD</p>
            </li>
            <li>
              <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/0e58a94dda219766d98c7796b910beee.svg" alt="shop">
              <p>SHOP</p>
            </li>
            <li>
              <img src="" alt="useravt-api">
              <p>PROFILE</p>
            </li>
            <li>
              <img src="https://d35aaqx5ub95lt.cloudfront.net/vendor/7159c0b5d4250a5aea4f396d53f17f0c.svg" alt="more">
              <p>MORE</p>
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

#navigation li {
  list-style: none;
  display: flex;
  padding: 12px 28px;
  margin: 10px 20px 10px 0px;
  border-radius: 12px;
}

#navigation li:hover,
#logo-duolingo {
  cursor: pointer;
}

#navigation li:hover {
  background-color: #e3e3e3;
}

#navigation li img {
  height: 30px;
  width: 30px;
  margin-right: 12px;
}

#navigation li p {
  color: #777777;
  font-weight: bold;
  align-self: center;
}


</style>
