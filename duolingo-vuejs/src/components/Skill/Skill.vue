<script>
import SkillHeader from './SkillHeader.vue'
import SkillBody from './SkillBody.vue'
import SkillFooter from './SkillFooter.vue'
import router from '../../router'
import loading from '../Loading.vue'
import { apiService } from '../apiService'

export default {
  name: 'Skill',
  components: {
    loading,
    SkillHeader,
    SkillBody,
    SkillFooter
  },
  data() {
    return {
      apiUrl : import.meta.env.VITE_API_URL,
      selectAnswerId : null,
      isLoading : true,
      skillsId : null,
      questionsData : [],
      currentQuestion: 0,
      selectAnswerTitle: null,
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
    console.log(this.skillsId)

    const getQuestion = await apiService.getListQuestions(skillId);

    //get questions
    getQuestion.forEach(({a_audio, a_id, a_image, a_question_id, a_title, q_answer, q_audio, q_description, q_id, q_image, q_template_name, q_title}) => {
      const questionIndex = this.questionsData.findIndex(({question}) => question.q_id === q_id);
      if (questionIndex === -1) {
        // const questionsObj = {id: q_id, title: q_title, description: q_description, answer: q_answer, template: q_template_name, audio: q_audio, image: q_image};
        this.questionsData.push({
          question: {q_id, q_title, q_description, q_answer, q_template_name, q_audio, q_image},
          answers: [{id: a_id, question_id: a_question_id, title: a_title, audio: a_audio, image: a_image}]
        });
      } else {
        this.questionsData[questionIndex].answers.push({id: a_id, question_id: a_question_id, title: a_title, audio: a_audio, image: a_image});
      }
    });

    console.log(this.questionsData)

    //shuffle the answers
    this.questionsData.forEach(({answers}) => {
    for (let i = answers.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [answers[i], answers[j]] = [answers[j], answers[i]];
    }
    });

    this.isLoading = false;
  },

  async mounted() {

  },
  
  methods: {
    selectAnswerHandle(id, answer) {
      this.selectAnswerTitle = answer,
      this.selectAnswerId = id
    }
  }
}
</script>

<template>
  <div v-if="isLoading">
    <loading :loadingMessage="loadingMessage"/>
  </div>
  <div v-if="!isLoading" id="container">
    <SkillHeader :questionsData="questionsData" :currentQuestion="currentQuestion"/>
    <SkillBody :questionsData="questionsData" :currentQuestion="currentQuestion" @select-answer="selectAnswerHandle"/>
    <SkillFooter :questionsData="questionsData" :currentQuestion="currentQuestion" :selectAnswerTitle="selectAnswerTitle" :selectAnswerId="selectAnswerId" @next-question="currentQuestion = $event"/>
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
