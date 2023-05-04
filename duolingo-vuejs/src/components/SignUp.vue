<script>
  import { RouterLink } from 'vue-router';
  import axios from 'axios'
  import router from '../router';

  export default {
    data() {
        return {
            signupMessage: "",
            isVisible: false,
            apiUrl: import.meta.env.VITE_API_URL,
            age: '',
            name : '',
            email : '',
            pw : '',
            cfpw : '',
            alertMessage : '',
            isfetching : false
        };
    },
    methods: {
        async signUp(e) {
            var formData = new FormData(this.$refs.signupForm);
            if (!this.blankInput) {this.alertMessage = 'Please enter all fields'}
            else if (!this.isValidEmail) {this.alertMessage = 'Please enter valid email'}
            else { if (!this.isMatchingPw) {
              this.alertMessage = 'Confirm your password again'
            } else {
              this.isfetching = !this.isfetching
              await axios.post(this.apiUrl + "?folder=sign-up", formData)
                .then(response => {
                this.isfetching = !this.isfetching
                if (response.data.msg === "email error") {
                  this.alertMessage = 'Please try another email'
                } else if (response.data.msg === "ok") {
                  alert('Sign up successfully. Please sign in!')
                  router.push('/sign-in')
                } else {
                  this.alertMessage = "Sign up failed. Please try again!";
                }
              })
                .catch(error => {
                console.error(error);
              });
            }
            }
        },

        resetError() {
            this.alertMessage = '';
        },

        showHandle() {
            this.isVisible = true;
        },

        hideHandle() {
            this.isVisible = false;
        }
    },
    computed: {
    isValidEmail() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(this.email);
    },

    blankInput() {
      return this.age && this.name && this.email && this.pw && this.cfpw
    },

    isMatchingPw() {
      return this.pw === this.cfpw
    }
    },
}
</script>

<template>
  <div class="sign-up">
    <header>
      <div id="header">
        <RouterLink to="/"><font-awesome-icon id="close-button" icon="fa-solid fa-xmark" /></RouterLink>
        <RouterLink to="/sign-in"><button>SIGN IN</button></RouterLink>
      </div>
    </header>

    <body>
      <div id="body">
        <h2>Create your profile</h2>
        <form id="signup-form" ref="signupForm" @submit.prevent="signUp" @click="resetError">
          <div @mouseleave="hideHandle">
            <input class="user-input" v-model="age" type="number" placeholder="Age" name="age">
            <font-awesome-icon @mouseover="showHandle" id="icon-question" icon="fa-solid fa-circle-question" />
            <span v-if="isVisible">Providing your age ensures you get the right Duolingo experience. For more details, please visit our <a href="">Privacy Policy</a>.</span>
          </div>
          <input class="user-input" type="text" v-model="name" placeholder="Name" name="name">
          <div>
            <input class='user-input' v-model="email" type="text" placeholder="Email" name="email">
          </div>
          <input class="user-input" type="password" v-model="pw" placeholder="Password" name="pw"> 
          <div>
            <input class="user-input" type="password" v-model="cfpw" placeholder="Confirm password" name="cfpw">
          </div>
          <h5> {{  alertMessage }}</h5>
          <input id="submit" :disabled="isfetching" type="submit" value="CREATE ACCOUNT" name="submit">
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

<style scoped>

</style>
