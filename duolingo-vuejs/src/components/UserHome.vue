<script>
import UserNav from './UserHome/UserNav.vue'
import UserLearn from './UserHome/UserLearn.vue'
import router from '../router'
import Loading from './Loading.vue'
import { apiService } from './apiService'


export default {
  name: 'UserHome',
  components: {
    Loading,
    UserNav,
    UserLearn
  },

  data() {
    return {
      isLoading: true,
      unit: [],
      lesson: []
    }
  },

  methods: {

  },
  async created() {
    if (!JSON.parse(localStorage.getItem("user"))) {
      router.push('/')
    };

    const userDb = JSON.parse(localStorage.getItem('user'));
    
    try {
      while (localStorage.getItem('user') === null) {
        await new Promise(resolve => setTimeout(resolve, 100))
      }
      await apiService.fetchUnit(userDb.current_course_id);
      await apiService.fetchLesson(userDb.current_course_id);
      this.isLoading = false;
    } catch (error) {
      console.error('Error fetching data:', error);
    } 
  },
}

</script>


<template>
  <Loading v-if="isLoading"/>
  <div id="container" v-if="!isLoading">
    <div id="to-padding-left"></div>
    <div id="user-nav">
      <UserNav id="user-nav-component"/>
    </div>
    <div id="user-learn">
      <UserLearn id="user-learn-component"/>
    </div>
  </div>
</template>

<style scoped>
#container {
  display: flex;
  flex-direction: row;
}
#to-padding-left {
  width: 20vw;
}

#user-nav {
  margin-right: 28vw;
  position: absolute;
}

#user-nav-component {
  width: 100vw;
}

#user-learn {
  width: 78vw;
  /* display: flex;
  justify-content: center; */
}

#user-learn-component {
 display: flex;
 margin: 30px 0px 0px 30px;
 justify-self: center;
}
</style>
