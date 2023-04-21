<script>
import { defineAsyncComponent } from 'vue';

export default {
  name: 'SkillBody',
  props: {
    questionsData: {
      type: Array,
      required: true
    },
    currentQuestion: {
      type: Number,
      required: true
    },
    disableClick: {
      type: Boolean,
    },
    trueInRow: {
      type: Number,
    },
    isSummationSection: {
      type: Boolean,
    },

    isMissedQuestionSection: {
      type: Boolean
    },

    isEndingSection: {
      type: Boolean
    },

    endingSectionTemplate : {
      type: Number
    }


  },

  emits: ['next-question','select-answer'],
  watch: {
    currentQuestion(nextQuestion) {
      this.$emit('next-question', nextQuestion);
      this.QuestionTemplate = this.questionsData[this.currentQuestion].question.template_name
      this.currentQuestionData = this.questionsData[this.currentQuestion]
    },

    isSummationSection: {
      immediate: true,
      handler(newVal) {
        this.handleSummationSection(newVal);
      }
    },

    trueInRow: {
      immediate: true,
      handler(newVal) {
        this.handleTrueInRowChange(newVal);
      }
    },

    isMissedQuestionSection(newVal) {
    if (newVal) {
      this.QuestionTemplate = 'missed questions'
      }
    },

    isEndingSection(newVal) {
    if (newVal === true) {
      this.QuestionTemplate = 'ending section'
      }
    }
  },

  data() {
    return {
      QuestionTemplate: '',
      isLoading: true,
      currentQuestionData : null,
    };
  },

  methods: {
    selectAnswer(id, answer) {
      this.$emit('select-answer', id, answer)
    },

    handleSummationSection(newVal) {
      if (newVal === true && (this.trueInRow === 5 || this.trueInRow === 10)) {
        this.QuestionTemplate = 'break template';
      } else {
        this.currentQuestionData = this.questionsData[this.currentQuestion]
        this.QuestionTemplate = this.currentQuestionData.question.template_name
      }
    },

    handleTrueInRowChange(newVal) {
      if (this.isSummationSection === true && (newVal === 5 || newVal === 10)) {
        this.QuestionTemplate = 'break template';
      } else {
        this.currentQuestionData = this.questionsData[this.currentQuestion]
        this.QuestionTemplate = this.currentQuestionData.question.template_name
      }
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
        case 'word linking':
          return defineAsyncComponent(() => import('./SkillTemplate/WordLinking.vue'));
        case 'break template':
          return defineAsyncComponent(() => import('./SkillTemplate/BreakTemplate.vue'));
        case 'missed questions':
          return defineAsyncComponent(() => import('./SkillTemplate/MissedQuestionsTemplate.vue'));
        case 'ending section':
          return defineAsyncComponent(() => import('./SkillTemplate/EndingSection.vue'));
        default:
          return null;
      }
    },
  },
};
</script>

<template>
  <div id="container">
    <div v-if="disableClick" id="disable-click"></div>
    <section>
      <component :is="QuestionComponent" :currentQuestionData="currentQuestionData" @select-answer="selectAnswer" :trueInRow = "trueInRow" :currentQuestion = "currentQuestion" :endingSectionTemplate = "endingSectionTemplate" />
    </section>
  </div>
</template>

<style scoped>
#container {
  display: flex;
  align-items: center;
}

#container section {
  width: 1000px;
  min-width: 670px;
  margin: 0 auto;
  padding: 1rem;
  display: flex;
  justify-content: center;
  flex-direction: row;
  height: 100%;
}

#disable-click {
  position: absolute;
  width: 100%;
  height: 100%;
  z-index: 1;
}
</style>