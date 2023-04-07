<script>
import LessonHeader from './LessonHeader.vue'
import LessonBody from './LessonBody.vue'
import LessonFooter from './LessonFooter.vue'
import router from '../../router'
import loading from './../Loading.vue'
import { apiService } from '../apiService'

export default {
  name: 'Lesson',
  components: {
    loading,
    LessonHeader,
    LessonBody,
    LessonFooter
  },
  data() {
    return {
      apiUrl : import.meta.env.VITE_API_URL,
      isLoading : false
    }
  },
  async created() {
    if (!localStorage.getItem("user")) {
      router.push('/')
    };

    const userDb = JSON.parse(localStorage.getItem("user"))
  },

  mounted() {
    const lesson_id = this.$route.params.lesson_id;
    
    console.log(lesson_id, this.apiUrl)
  }
}
</script>

<template>
  <div v-if="isLoading">
    <loading />
  </div>
  <div v-if="!isLoading" id="container">
    <LessonHeader />
    <LessonBody />
    <LessonFooter />
  </div>
</template>

<style scoped>
  #loading {
    display: flex;
    flex-direction: column;
    background-color: #fcfcff;
    width: 100vw;
    min-width: fit-content;
    height: 100vh;
    min-height: fit-content;
    align-items: center;
    justify-content: center;
    padding-bottom: 10%;
  }

  #loading img {
    height: 360px;
    width: 400px;
  }

  #loading p {
    width: fit-content;
    max-width: 80%;
    text-align: center;
    font-size: 16px;
    font-weight: bolder;
    color: #727272;
    margin: 10px 0px;
  }

  #container {
    width: 100vw;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    height: 100vh;
  }
</style>
