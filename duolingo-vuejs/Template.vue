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

<!-- <template>
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
        const response = await axios.get('http://localhost/www/get-answers.php');
        this.posts = response.data;
      } catch (error) {
        console.error('Error fetching posts:', error);
      }
      console.log(this.posts);
    },
  },
};
</script> -->

<template>
  <div>
    <ul>
      <li v-for="post in posts" :key="post.id">
        <h2>{{ post.code }}</h2>
        <p>{{ post.title }}</p>
        <img id="img" :src="'data:image/jpeg;base64,' + post.image" />
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
      const response = await fetch('http://localhost/www/VueJS/duolingo-vuejs/back-end/index.php'+'?folder=courses');
      const data = await response.json();
      this.posts = data;
      console.log(data[0].image)
    } catch (error) {
      console.error('Error fetching posts:', error);
    }
  },
};
</script>

<style>
#img {
  width: 500px;
}
</style>


