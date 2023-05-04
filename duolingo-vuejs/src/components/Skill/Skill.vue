<script>
import SkillHeader from './SkillHeader.vue'
import SkillBody from './SkillBody.vue'
import SkillFooter from './SkillFooter.vue'
import router from '../../router'
import loading from '../Loading.vue'
import { apiService } from '../apiService'
import { is } from '@babel/types'

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
      loadingMessage: '15 minutes a day can teach you a language. What can 15 minutes of social media do?',
      disableClick : null,
      trueInRow : null,
      isSummationSection : null,
      missedQuestionData : [],
      trueAnswerTotal : 0,
      isMissedQuestionSection : null,
      isEndingSection : null,
      endingSectionTemplate : null,
      isDisableHeader : false
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
    //get questions
    getQuestion.forEach(({a_audio, a_id, a_image, a_question_id, a_title, q_answer, q_audio, q_description, q_id, q_image, q_template_name, q_title}) => {
      const questionIndex = this.questionsData.findIndex(({question}) => question.id === q_id);
      if (questionIndex === -1) {
        this.questionsData.push({
          question: {id: q_id, title: q_title, description: q_description, answer: q_answer, template_name: q_template_name, audio: q_audio, image: q_image},
          answers: [{id: a_id, question_id: a_question_id, title: a_title, audio: a_audio, image: a_image}]
        });
      } else {
        this.questionsData[questionIndex].answers.push({id: a_id, question_id: a_question_id, title: a_title, audio: a_audio, image: a_image});
      }
    });

    //shuffle the answers
    this.questionsData.forEach(({answers}) => {
    for (let i = answers.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [answers[i], answers[j]] = [answers[j], answers[i]];
    }
    });

    this.isLoading = false;
  },
  
  methods: {
    selectAnswerHandle(id, answer) {
      this.selectAnswerId = id,
      this.selectAnswerTitle = answer
    },

    handleDisbaleClick(newValue) {
      this.disableClick = newValue;
    },

    handleSummationSection(trueAnswer, isSummationSection) {
      this.trueInRow = trueAnswer;
      this.isSummationSection = isSummationSection
    },

    answerValidate(id, result) {
      if (!result) {
        this.questionsData.push(this.questionsData[id])
      } else {
        this.trueAnswerTotal++;
      }
    },

    missedQuestionsSection(isMissedQuestionSection) {
      this.isMissedQuestionSection = isMissedQuestionSection
    },

    endingSection(isEndingSection, template) {
      this.isEndingSection = isEndingSection;
      this.endingSectionTemplate = template
    },

    disableHeaderHandle(isTrue) {
      this.isDisableHeader = isTrue
    }

  }
}
</script>

<template>
  <div v-if="isLoading">
    <loading :loadingMessage="loadingMessage"/>
  </div>
  <div v-if="!isLoading" id="skill-container">
    <SkillHeader v-if="!isDisableHeader" :questionsData="questionsData" :trueAnswerTotal="trueAnswerTotal" :currentQuestion="currentQuestion"/>
    <SkillBody :questionsData="questionsData" :currentQuestion="currentQuestion" @select-answer="selectAnswerHandle" :disableClick = "disableClick" :trueInRow = "trueInRow" :isSummationSection = "isSummationSection" :isMissedQuestionSection = "isMissedQuestionSection" :isEndingSection = "isEndingSection" :endingSectionTemplate = "endingSectionTemplate"/>
    <SkillFooter :questionsData="questionsData" :currentQuestion="currentQuestion" :selectAnswerTitle="selectAnswerTitle" :selectAnswerId="selectAnswerId" @next-question="currentQuestion = $event" @disable-click="handleDisbaleClick" @summation-section = "handleSummationSection" @answer-validate = "answerValidate" @missed-questions-section = "missedQuestionsSection" @ending-section="endingSection" @disable-header="disableHeaderHandle" />
  </div>
</template>
