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
      lesson: [],
      loadingMessage: 'Please wait while we are fetching your data'
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
  <Loading v-if="isLoading" :loadingMessage="loadingMessage"/>
  <div id="user-home" v-if="!isLoading">
    <div id="user-nav">
      <UserNav id="user-nav-component"/>
    </div>
    <div id="user-learn" v-if="true">
      <UserLearn id="user-learn-component"/>
    </div>
  </div>
</template>
