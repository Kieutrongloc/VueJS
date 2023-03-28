<!-- <script>
  import { RouterLink } from 'vue-router';
  export default {
    data() {
      return {
        
      }
    },
    methods: {

    }
  }
</script>

<template>
  <div class="container">
    <p>Hello</p>
  </div>
</template>

<style scoped>

</style> -->

<template>
  <div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      posts: [],
    };
  },
  created() {
    this.getCourses();
  },
  methods: {
    async getCourses() {
      try {
        const response = await axios.get('http://localhost/www/AppleStore/Duolingo/get-courses.php');
        this.posts = response.data;
      } catch (error) {
        console.error('Error fetching posts:', error);
      }
      console.log(this.posts);
    },
  },
};
</script>

