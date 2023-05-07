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
            {id: 8, title: 'Privacy', link: '/user-home/setting/privacy'},
        ],
        footerNavList : [
            {id: 1, title: 'ABOUT', link: ''},
            {id: 2, title: 'BLOG', link: ''},
            {id: 3, title: 'SCHOOLS', link: ''},
            {id: 4, title: 'APPS', link: ''},
            {id: 5, title: 'STORE', link: ''},
            {id: 6, title: 'EFFICACY', link: ''},
            {id: 7, title: 'HELP', link: ''},
            {id: 8, title: 'GUIDELINES', link: ''},
            {id: 9, title: 'CAREERS', link: ''},
            {id: 10, title: 'INVESTORS', link: ''},
            {id: 11, title: 'TERMS', link: ''},
            {id: 12, title: 'PRIVACY', link: ''},
        ],
        selectedNav : 0,
        isDisableBtn : true,
        isHidden : false,
        formData : null
    };
  },

  methods: {
    selectedNavHandle(id) {
        this.selectedNav = id
    },

    showNavbar() {
        this.isHidden = !this.isHidden
    },

    formDataHandle(formData) {
        if (formData !== false) {
            this.isDisableBtn = false
            this.formData = formData
        } else {
            this.isDisableBtn = true
        }
    },

    submitData() {
        console.log(this.formData)
    }
  },

  computed: {
    userAvatar() {
        return this.userData.avatar === '' ? '/src/assets/img/addition/default-avatar.png' : this.userData.avatar;
    },
    
    switchSetting() {
        switch (this.settingComponent) {
        case 'account':
            return defineAsyncComponent(() => import('./UserSetting/AccountSetting.vue'));
        case 'courses':
            return defineAsyncComponent(() => import('./UserSetting/CoursesSetting.vue'));
        case 'password':
            return defineAsyncComponent(() => import('./UserSetting/PasswordSetting.vue'));
        default:
          return null;
        }
    }
  },

  created() {
    this.selectedNav = this.settingNavList.findIndex(item => item.link === this.$route.path) + 1
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
        <div id="component-box">
            <component :is="switchSetting" @form-data='formDataHandle'></component>
        </div>

        <div id="footer_content">
            <footer>
                <div id="footer_nav">
                <div class="footer-items" v-for="item in footerNavList" :key="item.id">
                    <RouterLink :to="item.link"><p>{{ item.title }}</p></RouterLink>
                </div>
                </div>
            </footer>
        </div>
    </div>
    
    <div id="setting-side-bar">
        <div id="setting_side_bar_box">
            <div id="save-change">
                <div id="show-nav" @click="showNavbar">
                    <font-awesome-icon v-if="!isHidden" class="bars-icon" :icon="['fas', 'bars']" />
                    <font-awesome-icon v-else class="bars-icon" :icon="['fas', 'xmark']" />
                </div>
                <button :disabled="isDisableBtn" @click="submitData">SAVE CHANGES</button>
            </div>
            <div id="setting-box" :class="[isHidden ? 'mobile-responsive' : '']" @click="showNavbar">
                <div id="user-info">
                    <img :src="userAvatar" alt="user-avatar">
                    <div id="user-name">
                        <p>{{ userData.user_name }}</p>
                        <RouterLink id="view-profile" to="/user-home/profile">VIEW YOUR PROFILE</RouterLink>
                    </div>
                </div>
                <div id="setting-nav">
                    <ul>
                        <li @click="selectedNavHandle(item.id)" v-for="item in settingNavList" :key="item.id">
                            <RouterLink :class="[selectedNav === item.id ? 'selected-nav' : '']" :to="item.link">
                                <p class="link">{{ item.title }}</p>
                            </RouterLink>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>


