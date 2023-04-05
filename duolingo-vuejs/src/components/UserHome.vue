<script>
import { RouterLink, RouterView } from 'vue-router'
import UserNav from './UserHome/UserNav.vue'
import UserLearn from './UserHome/UserLearn.vue'

import router from '../router'
export default {
  name: 'UserHome',
  components: {
    UserNav,
    UserLearn
  },

  data() {
    return {

    }
  },

  methods: {

  },
  created() {
    if (!JSON.parse(localStorage.getItem("user"))) {
      router.push('/')
    }
  },
}

</script>



<template>
  <div id="container">
    <UserNav />
    <div id="nav-bar">
      <UserLearn />
    </div>
  </div>
</template>

<style scoped>
#container {
  display: flex;
  flex-direction: row;
}
#nav-bar {
  display: flex;
  justify-self: center;
}
</style>
