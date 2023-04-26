<script>
export default {
  name: 'TextSelecting',
  props: {
    currentQuestionData: {
      type: Object,
      required: true
    },
    currentQuestion : {
      type: Number,
      required: true
    }
  },

  data() {
    return {
      selectedAnswerId : null,
      selectedAnswer : null,
    };
  },

  watch: {
    currentQuestion: {
      immediate: true,
      handler(newVal) {
        this.selectedAnswerId = null,
        this.selectedAnswer = null
      }
    }
  },
  
  async created() {
    while ((this.currentQuestionData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }
  },

  methods: {
    selectAnswer(answer) {
      new Audio(answer.audio).play()
      this.selectedAnswerId = answer.id
      this.selectedAnswer = answer.title
      this.$emit('select-answer', this.selectedAnswerId, this.selectedAnswer);
    }
  }
};
</script>

<template>
  <div id="text-selecting">
    <!-- Template text selecting  -->
    <div class="question-template" id="template-text-selecting">
        <h1 class="question">{{ currentQuestionData.question.title }}</h1>

        <div class="answer-list">

          <div :class="['answer-box', { 'selected-answer': selectedAnswerId === answer.id }]" v-for="(answer, index) in currentQuestionData.answers" :key="answer.id" @click="selectAnswer(answer)">
            <div class="text">
              <span>{{ index + 1 }}</span>
              <p>{{ answer.title }}</p>
            </div>
          </div>

        </div>
      </div>
  </div>
</template>