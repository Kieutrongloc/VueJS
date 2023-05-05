<script>
import UserNav from './UserHome/UserNav.vue'
// import UserLearn from './UserHome/UserLearn.vue'
import router from '../router'
import Loading from './Loading.vue'
import { apiService } from './apiService'
import { defineAsyncComponent } from 'vue';

export default {
  name: 'UserHome',
  components: {
    Loading,
    UserNav,
  },

  data() {
    return {
      isLoading: true,
      unit: [],
      lesson: [],
      loadingMessage: 'Please wait while we are fetching your data',
      bodyComponent: this.$route.params.switch_body,
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

  watch: {
    '$route': function() {
      this.bodyComponent = this.$route.params.switch_body;
    }
  },

  computed: {
    switchComponent() {
      switch (this.bodyComponent) {
        case 'learn':
          return defineAsyncComponent(() => import('./UserHome/UserLearn.vue'));
        case 'profile':
          return defineAsyncComponent(() => import('./UserHome/UserProfile.vue'));
        case 'setting':
        return defineAsyncComponent(() => import('./UserHome/UserSetting.vue'));
        default:
          return null;
      }
    }
  }
}

</script>


<template>
  <Loading v-if="isLoading" :loadingMessage="loadingMessage"/>
  <div id="user-home" v-if="!isLoading">
    <div id="user-nav">
      <UserNav/>
    </div>
    <div id="user-learn" v-if="true">
      <component :is="switchComponent"></component>
    </div>
  </div>
</template>
