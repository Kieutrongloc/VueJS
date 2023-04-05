<script>
import GameHeader from './GameHeader.vue'
export default {
  name: 'Game',
  components: {
    GameHeader
  },
  data() {
    return {
      apiUrl : import.meta.env.VITE_API_URL,
      isLoading : false,
      questions: []
    }
  },
  async created() {
    // this.isLoading = false;
  },
  methods: {},
  mounted() {
  }
}
</script>

<template>
  <div id="loading" v-if="isLoading">
    <img src="./../../assets/img/duolingo-loading.gif" alt="loading">
    <p>15 minutes a day can teach you a language. What can 15 minutes of social media do?</p>
  </div>
  <div v-if="!isLoading" id="container" class="container">
    <GameHeader />
  </div>
</template>

<style scoped>


</style>
