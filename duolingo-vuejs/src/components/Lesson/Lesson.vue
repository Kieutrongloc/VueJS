<script>
import LessonHeader from './LessonHeader.vue'
import LessonBody from './LessonBody.vue'
import LessonFooter from './LessonFooter.vue'
import router from '../../router'
// import apiAnswer from './lessonApi'

export default {
  name: 'Lesson',
  components: {
    LessonHeader,
    LessonBody,
    LessonFooter
  },
  data() {
    return {
      apiUrl : import.meta.env.VITE_API_URL,
      isLoading : true
    }
  },
  async created() {
    if (!localStorage.getItem("user")) {
      router.push('/')
    };

    const userDb = JSON.parse(localStorage.getItem("user"))
    try {
      const questionsResponse = await fetch(this.apiUrl+'?folder=questions'+'&unit_id='+userDb.current_unit +'&lesson_id='+userDb.current_lesson);
      const data = await questionsResponse.json();
      this.questions = JSON.parse(JSON.stringify(data));
      localStorage.setItem("questions", JSON.stringify(this.questions));
      this.isLoading = false;
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  },

  mounted() {
    const lesson_id = this.$route.params.lesson_id;
    console.log(lesson_id)
  }
}
</script>

<template>
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
