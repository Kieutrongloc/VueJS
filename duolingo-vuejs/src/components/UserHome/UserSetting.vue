<script>
import router from '../../router'
import { RouterLink } from 'vue-router';
import { defineAsyncComponent } from 'vue';

export default {

  data() {
    return {
        userData : JSON.parse(localStorage.getItem('user')),
        settingComponent: this.$route.params.switch_setting,
        settingNavList : [
            {id: 1, title: 'Account', link: '/user-home/setting/account'},
            {id: 2, title: 'Manage Courses', link: '/user-home/setting/courses'},
            {id: 3, title: 'Password', link: '/user-home/setting/password'},
            {id: 4, title: 'Super Duolingo', link: '/user-home/setting/super'},
            {id: 5, title: 'Notifications', link: '/user-home/setting/notifications'},
            {id: 6, title: 'Edit daily Goal', link: '/user-home/setting/goal'},
            {id: 7, title: 'Duolingo for Schools', link: '/user-home/setting/schools'},
            {id: 7, title: 'Privacy', link: '/user-home/setting/privacy'},
        ]
    };
  },

  methods: {
    
  },

  computed: {
    userAvatar() {
        return this.userData.avatar === '' ? '/src/assets/img/addition/default-avatar.png' : this.userData.avatar;
    },
    
    switchSetting() {
        switch (this.settingComponent) {
        case 'account':
            return defineAsyncComponent(() => import('./UserSetting/AccountSetting.vue'));
        default:
          return null;
        }
    }
  },

  created() {

  },

  watch: {
    '$route': function() {
      this.settingComponent = this.$route.params.switch_setting;
    }
  },

};
</script>

<template>
  <div id="user-setting">
    <div id="setting-component">
        <component :is="switchSetting"></component>
    </div>
    <div id="setting-side-bar">
        <div id="save-change">
            <button :disabled="false">SAVE CHANGES</button>
        </div>
        <div id="setting-nav">
            <div id="user-info">
                <img src="" alt="">
                <div id="user-name">
                    <p></p>
                    <RouterLink id="view-profile" to="/user-home/profile">VIEW YOUR PROFILE</RouterLink>
                </div>
            </div>
            <div id="setting-nav">
                <ul>
                    <li v-for="item in settingNavList" :key="item.id">
                        <RouterLink class="link" :to="item.link">{{ item.title }}</RouterLink>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  </div>
</template>


