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
    <ul>
      <li v-for="post in posts" :key="post.id">
        <h2>{{ post.code }}</h2>
        <p>{{ post.title }}</p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
    };
  },
  async mounted() {
    try {
      const response = await fetch('./../../../back-end/courses/get-courses.php');
      const data = await response.json();
      this.posts = data;
    } catch (error) {
      console.error('Error fetching posts:', error);
    }
    console.log(this.posts);
  },
};

</script>

