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
  <div>
    <h1>404 - Not Found</h1>
    <p>The page you are looking for does not exist.</p>
    <RouterLink id="direct-link" to="/">Go back to homepage</RouterLink>
  </div>
</template>

<style scoped>
  #direct-link {
    color: rgb(0, 0, 0);
    text-decoration: none;
  }

  #direct-link:hover {
    color: blue;
  }
</style>