<script>
  import { RouterLink } from 'vue-router';
  import axios from 'axios'
  import router from '../router';
  export default {
    data() {
      return {
        signinMessage: '',
        apiUrl : import.meta.env.VITE_API_URL,
      }
    },
    methods: {
      signIn(e) {
        var formData = new FormData(this.$refs.signinForm);
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(formData.get('id') === '' || formData.get('pw') === '') {
          this.signinMessage = 'Please enter both email and password';
        } else if (!emailRegex.test(formData.get('id'))) {
          this.signinMessage = 'Please enter valid email';
        } else {
          axios.post(this.apiUrl + '?folder=sign-in', formData)
          .then(response => {
            if (response.data.msg === 'ok') {
              localStorage.setItem("user", JSON.stringify(response.data.user));
              router.push('/user-home/learn')
            } else {
              this.signinMessage = 'Sign in failed';
            }
          })
          .catch(error => {
            console.error(error);
          });
        }
      }
    },

    mounted() {
    if (localStorage.getItem("user")) {
      router.push('/user-home/learn')
    }
  },
  }
</script>

<template>
  <div class="sign-in">
    <header>
      <div id="header">
        <RouterLink to="/"><font-awesome-icon id="close-button" icon="fa-solid fa-xmark" /></RouterLink>
        <RouterLink to="/sign-up"><button>SIGN UP</button></RouterLink>
      </div>
    </header>

    <body>
      <div id="body">
        <h2>Log in</h2>
        <form ref="signinForm" @submit.prevent="signIn">
          <input class="user-input" type="text" placeholder="Email or username" name="id">
          <div>
            <input class="user-input" type="password" placeholder="Password" name="pw">
            <span id="forgot">FORGOT?</span>
          </div>
          <p id="signin-message"> {{ signinMessage }}</p>
          <input id="submit" type="submit" value="LOG IN" name="submit">
        </form>
        <div id="text-or">
          <div></div>
          <h3>OR</h3>
        </div>
        <div id="signin-alt">
          <button id="facebook">
            <img src="https://icons-for-free.com/iconfiles/png/512/facebook+logo+logo+website+icon-1320190502625926346.png" alt="facebook">
            <span>FACEBOOK</span>
          </button>
          <button id="google">
            <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" alt="google">
            <span>GOOGLE</span>
          </button>
        </div>
      </div>
    </body>

    <footer>
      <div id="footer">
        <p id="policy">By signing in to Duolingo, you agree to our <a href="">Terms</a> and <a href="">Privacy Policy</a>.</p>
        <p>This site is protected by reCAPTCHA Enterprise and the Google <a href="">Privacy Policy</a> and <a href="">Terms of Service apply</a>.</p>
      </div>
    </footer>
  </div>
</template>
