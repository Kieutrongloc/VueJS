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
      isLoading : true,
      skillsId : null,
      questionsData : null,
      currentQuestion: 0,
      loadingMessage: '15 minutes a day can teach you a language. What can 15 minutes of social media do?'
    }
  },
  async created() {
    if (!localStorage.getItem("user")) {
      router.push('/')
    };

    const unitId = this.$route.params.unit_id;
    const lessonId = this.$route.params.lesson_id;
    try {
      this.skillsId = (await apiService.fetchSkills()).map(obj => obj.id)
    } catch (error) {
      console.error('Fetching skills error:', error);
    }

    const shuffledSkillsId = this.skillsId.sort(() => Math.random() - 0.5);
    const getQuestion = shuffledSkillsId.slice(0, 5).map((skillId) => apiService.getRandomQuestions(unitId, lessonId, skillId, 2));
    this.questionsData = (await Promise.all(getQuestion)).flat();
    
    // console.log(unitId, lessonId, this.apiUrl, shuffledSkillsId, this.questionsData, this.questionsData[1])
    this.isLoading = false;
  },

  async mounted() {

  },
  
  methods: {
    
  }
}
</script>

<template>
  <div v-if="isLoading">
    <loading :loadingMessage="loadingMessage"/>
  </div>
  <div v-if="!isLoading" id="container">
    <LessonHeader :questionsData="questionsData" :currentQuestion="currentQuestion"/>
    <LessonBody :questionsData="questionsData" :currentQuestion="currentQuestion" />
    <LessonFooter :questionsData="questionsData" :currentQuestion="currentQuestion" @next-question="currentQuestion = $event"/>
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
