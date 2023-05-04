<script>
  import { RouterLink } from 'vue-router';
  export default {
    name: 'NotFound',
    data() {
      return {

      }
    },
    methods: {

    }
  }
</script>

<template>
  <div id="not-found">
    <h1>404 - Not Found</h1>
    <p>The page you are looking for does not exist.</p>
    <RouterLink id="direct-link" to="/">Go back to homepage</RouterLink>
  </div>
</template>

<style scoped>
  #not-found {
    padding-left: 10vw;
    padding-top: 10vh;
  }
  #direct-link {
    color: rgb(65, 65, 65);
    text-decoration: none;
    font-style: italic;
  }

  #direct-link:hover {
    color: blue;
  }
</style>