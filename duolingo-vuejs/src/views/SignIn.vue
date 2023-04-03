<script>
  import { RouterLink } from 'vue-router';
  import axios from 'axios'
  import router from '../router';
  export default {
    data() {
      return {
        signinMessage: ''
      }
    },
    methods: {
      signIn(e) {
        var formData = new FormData(this.$refs.signinForm);
        axios.post('http://localhost/www/VueJS/duolingo-vuejs/back-end/index.php'+ '?folder=sign-in', formData)
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
    },
    mounted() {
    const user = localStorage.getItem("user");
    if (user) {
      router.push('/user-home/learn')
    }
  },
  }
</script>

<template>
  <div class="container">
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

#signin-message {
  position: absolute;
  bottom: 90px;
  color: red;
  left: 20px;
  font-size: 14px;
}

#body h2 {
  font-weight: bolder;
  margin-bottom: 20px;
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
  margin: 40px 0px 20px;
}

#body form #submit:hover {
  cursor: pointer;
  background-color: rgb(79, 198, 253);
}

#body form ::placeholder {
  color: #8e8e8e;
}

#body form #forgot {
  position: absolute;
  right: 6px;
  bottom: 18px;
  color: #8e8e8e;
  font-weight: bolder;
}

#body form #forgot:hover {
  cursor: pointer;
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
