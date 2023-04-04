<script>
import LessonHeader from './LessonHeader.vue'
import LessonBody from './LessonBody.vue'
import LessonFooter from './LessonFooter.vue'
import router from '../../router'

export default {
  name: 'Lesson',
  components: {
    LessonHeader,
    LessonBody,
    LessonFooter
  },
  data() {
    return {
      // questions: []

    }
  },
  async created() {
    if (!localStorage.getItem("user")) {
      router.push('/')
    };

    const userDb = JSON.parse(localStorage.getItem("user"))

    try {
      const questionsResponse = await fetch('http://localhost/www/VueJS/duolingo-vuejs/back-end/index.php'+'?folder=questions'+'&unit_id='+userDb.current_unit +'&lesson_id='+userDb.current_lesson);
      const data = await questionsResponse.json();
      this.questions = JSON.parse(JSON.stringify(data));
      localStorage.setItem("questions", JSON.stringify(this.questions));
    } catch (error) {
      console.error('Error fetching data:', error);
    }    
    },

  mounted() {
  }
}
</script>

<template>
  <div id="container">
    <LessonHeader />
    <LessonBody />
    <LessonFooter />
  </div>
</template>

<style scoped>
  #container {
    width: 100vw;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    height: 100vh;
  }
</style>
