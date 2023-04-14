<script>
import { defineAsyncComponent } from 'vue';

export default {
  name: 'LessonBody',
  props: {
    questionsData: {
      type: Array,
      required: true
    },
    currentQuestion: {
      type: Number,
      required: true
    }
  },

  emits: ['next-question','select-answer'],
  watch: {
    currentQuestion(nextQuestion) {
      this.$emit('next-question', nextQuestion);
      this.QuestionTemplate = this.questionsData[this.currentQuestion].question.q_template_name
      this.currentQuestionData = this.questionsData[this.currentQuestion]
    }
  },

  data() {
    return {
      QuestionTemplate: '',
      isLoading: true,
      currentQuestionData : null,
      // selectedAnswer : null,
    };
  },

  methods: {
    selectAnswer(id, answer) {
      this.$emit('select-answer', id, answer)
    }
  },

  computed: {
    QuestionComponent() {
      switch (this.QuestionTemplate) {
        case 'image selecting':
          return defineAsyncComponent(() => import('./SkillTemplate/ImageSelecting.vue'));
        case 'text selecting':
          return defineAsyncComponent(() => import('./SkillTemplate/TextSelecting.vue'));
        case 'list selecting':
          return defineAsyncComponent(() => import('./SkillTemplate/ListSelecting.vue'));
        case 'list reordering':
          return defineAsyncComponent(() => import('./SkillTemplate/ListReordering.vue'));
        case 'word filling':
          return defineAsyncComponent(() => import('./SkillTemplate/WordFilling.vue'));
        case 'sentence reading':
          return defineAsyncComponent(() => import('./SkillTemplate/SentenceReading.vue'));
        case 'word listening':
          return defineAsyncComponent(() => import('./SkillTemplate/WordListening.vue'));
        default:
          return null;
      }
    },
  },

  async created() {
    while ((this.questionsData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }
    this.currentQuestionData = this.questionsData[this.currentQuestion]
    this.QuestionTemplate = this.currentQuestionData.question.q_template_name
  },

  async mounted() {

  }

};
</script>

<template>
  <div id="container">
    <content>
      <component :is="QuestionComponent" :currentQuestionData="currentQuestionData" @select-answer="selectAnswer" />
    </content>
  </div>
</template>

<style scoped>
#container {
  display: flex;
  align-items: center;
}

#container content {
  width: 1000px;
  min-width: 670px;
  margin: 0 auto;
  padding: 1rem;
  display: flex;
  justify-content: center;
  flex-direction: row;
  height: 100%;
}
</style>