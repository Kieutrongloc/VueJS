<script>
import router from '../../router'
import { RouterLink } from 'vue-router';

export default {

  data() {
    return {
        userData : JSON.parse(localStorage.getItem('user'))
    };
  },

  methods: {
    
  },

  computed: {
    userAvatar() {
        return this.userData.avatar === '' ? '/src/assets/img/addition/default-avatar.png' : this.userData.avatar;
    }
  },

  mounted() {
  }

};
</script>

<template>
  <div id="user-profile">
    <header>
        <div id="header-main">
            <div id="user-avatar">
                <img :src="userAvatar" alt="avatar">
                <font-awesome-icon class="icon" :icon="['fas', 'pen']" />
            </div>
            <div id='profile-info'>
                <p>{{ userData.user_name }}</p>
                <div id="join-date">
                    <font-awesome-icon class="icon" :icon="['fas', 'clock']" />
                    <span>Joined Date API</span>
                </div>
                <div id="profile-connection">
                    <font-awesome-icon class="icon" :icon="['fas', 'user-group']" />
                    <span>API Following / API Followers</span>
                </div>
                <div id="profile-learning-languages">
                    <ul id="learning-language">
                        <li><img src="https://cdn-icons-png.flaticon.com/128/330/330465.png" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="button-edit">
            <div>
                <RouterLink id="button" to="/user-home/setting/account">
                    <font-awesome-icon class="icon" :icon="['fas', 'pen']" />
                    <p>EDIT PROFILE</p>
                </RouterLink>
            </div>
        </div> 
    </header>

    <body>
        <div>
            <p>UPDATING</p>
        </div>
    </body>
  </div>
</template>


