<script>
  import { RouterLink } from 'vue-router';
  export default {
    data() {
      return {
        isVisible: false,
      }
    },
    methods: {
      signUp(e) {
        var formData = new FormData(this.$refs.signupForm);
        console.log(formData.get('id'), formData.get('pw'))
      },
      showHandle() {
        this.isVisible = true;
      },
      hideHandle() {
        this.isVisible = false;
      }
    }
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
        <form id="signup-form" ref="signupForm" @submit.prevent="signUp">
          <div @mouseleave="hideHandle">
            <input class="user-input" type="text" placeholder="Age" name="age">
            <font-awesome-icon @mouseover="showHandle" id="icon-question" icon="fa-solid fa-circle-question" />
            <span v-if="isVisible">Providing your age ensures you get the right Duolingo experience. For more details, please visit our <a href="">Privacy Policy</a>.</span>
          </div>
          <input class="user-input" type="text" placeholder="Name (optional)" name="name">
          <input class="user-input" type="text" placeholder="Email" name="id">
          <input class="user-input" type="password" placeholder="Password" name="pw">
          <input class="user-input" type="password" placeholder="Confirm password" name="cf-pw">
          <input id="submit" type="submit" value="CREATE ACCOUNT" name="submit">
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
