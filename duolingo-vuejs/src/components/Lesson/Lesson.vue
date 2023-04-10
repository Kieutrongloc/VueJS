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
    const lessonId = this.$route.params.lesson_id;
    const skillId = this.$route.params.skill_id;
    try {
      this.skillsId = (await apiService.fetchSkills(lessonId)).map(obj => obj.id)
    } catch (error) {
      console.error('Fetching skills error:', error);
    }
    const getQuestion = await apiService.getListQuestions(skillId);
    console.log('getQuestiond', getQuestion);
    // const newQuestions = [
    //   {
    //     question: { id: 1, content: '', img : '', audio: '', answer: 'banh mi'},
    //     answers: [
    //       { id: 1, title: 'banh mi', img : '', audio: '', question_id: 1},
    //       { id: 2, title: 'hoa qua', img : '', audio: '', question_id: 1},
    //       { id: 3, title: 'cafe', img : '', audio: '', question_id: 1},
    //     ]
    //   },
    //   {
    //     question: { id: 2, content: '', img : '', audio: '', answer: 'banh mi'},
    //     answers: [
    //       { id: 1, title: 'banh mi', img : '', audio: '', question_id: 1},
    //       { id: 2, title: 'hoa qua', img : '', audio: '', question_id: 1},
    //       { id: 3, title: 'cafe', img : '', audio: '', question_id: 1},
    //     ]
    //   },
    // ];
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
