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
  <div class="container">
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
#container {
  min-height: 100vh;
}

#header {
  margin: 40px 30px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

#header #close-button {
  font-size: 26px;
  color: #8e8e8e;
}

#header button {
  width: 100px;
  height: 50px;
  border-radius: 10px;
  background-color: white;
  color: rgb(28,175,246);
  font-size: 14px;
  font-weight: bolder;
  border: solid 2px #bdbdbd;
}

#header button:hover {
  cursor: pointer;
  background-color: #c9c9c9;
}

#body, #footer {
  display: flex;
  flex-direction: column;
  align-items: center;
}

#body h2 {
  font-weight: bolder;
  margin-bottom: 20px;
}

#body #signup-form {
  display: flex;
  flex-direction: column;
}

#body #signup-form span {
  position: absolute;
  width: 260px;
  font-size: 12px;
  text-align: center;
  border: 1px solid #c3c3c3;
  border-radius: 12px;
  padding: 16px;
  right: -90px;
  z-index: 1;
  background-color: white;
  top: 44px;
}

#body #signup-form span a {
  text-decoration: none;
  color: blue;
}

#body #icon-question {
  color: #a5a5a5;
  font-size: 20px;
  right: 30px;
}

#body #icon-question:hover {
  cursor: pointer;
}

#body form .user-input {
  width: 390px;
  height: 50px;
  border-radius: 16px;
  margin: 4px 0px;
  padding: 0px 20px 0px 10px;
  border: #dddddd solid 2px;
  font-size: 18px;
}

#body form #submit {
  width: 390px;
  height: 50px;
  border-radius: 10px;
  border: none;
  background-color: rgb(28,176,247);
  font-size: 18px;
  font-weight: bolder;
  color: white;
  margin: 20px 0px;
}

#body form #submit:hover {
  cursor: pointer;
  background-color: rgb(79, 198, 253);
}

#body form ::placeholder {
  color: #8e8e8e;
}

#body #text-or {
  display: flex;
  flex-direction: column;
  align-items: center;
}

#body #text-or div {
  border: solid rgb(201, 201, 201) 1px;
  width: 390px;
  position: absolute;
  top: 10px;
}

#body #text-or h3 {
  background-color: white;
  padding: 0px 10px;
  color: rgb(135, 135, 135);
  font-size: 14px;
}

#body #signin-alt {
  display: flex;
  width: 390px;
  justify-content: space-between;
  margin: 20px 0px 30px;
}

#body #signin-alt button {
  width: 190px;
  height: 50px;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: #c4c4c4 2px solid;
}

#body #signin-alt button:hover {
  cursor: pointer;
  background-color: #c9c9c9;
}

#body #signin-alt img {
  height: 30px;
  margin-right: 12px;
}

#body #signin-alt #facebook span {
  color: rgb(59,89,152);
  font-weight: bolder;
}

#body #signin-alt #google span {
  color: rgb(75,139,245);
  font-weight: bolder;
}

footer p {
  width: 390px;
  text-align: center;
  margin-bottom: 10px;
  color: rgb(193,193,193);
  font-size: 14px;
}

footer p a {
  text-decoration: none;
  color: rgb(136, 136, 136);
  font-weight: bolder;
}

/* @media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
} */
</style>
