<script>
export default {
  name: 'Congratulation',
  props: {

  },

  data() {
    return {

    };
  },

  watch: {

  },
  
  mounted() {
  },

  methods: {

  }
};
</script>

<template>
  <div id="congratulations">
    <!-- Template list selecting  -->
    <div id="container">
      <img src="/src/assets/img/addition/duolingo-backpack-walking.gif" alt="">
      <h2>Congratulations. You've earn 5 XP today</h2>
      <p>Practice Complete! <span class="xp-point">+5 XP</span></p>
    </div>
  </div>
</template>

<style scoped>
#congratulations #container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

#congratulations #container img {
  width: 240px;
  height: fit-content;
}

#congratulations #container h2 {
  font-weight: bolder;
}

#congratulations #container p {
  font-size: larger;
  color: #787878;
}

#congratulations #container .xp-point {
  color: #fed356;
  font-weight: bolder;
}

</style>