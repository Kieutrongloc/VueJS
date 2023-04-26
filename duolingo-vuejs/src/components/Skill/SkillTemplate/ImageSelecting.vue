<script>

export default {
  name: 'ImageSelecting',
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
      selectedAnswer : null
    };
  },
  
  async created() {
    while ((this.currentQuestionData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }
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
  <div id="image-selecting">
    <!-- Template image selecting -->
    <div class="question-template" id="template-image-selecting">
      <h1 class="question">{{ currentQuestionData.question.title }}</h1>
      <div class="answer-list">

        <div v-for="(answer, index) in currentQuestionData.answers" :key="answer.id" @click="selectAnswer(answer)" :class="['answer-box', { 'selected-answer': selectedAnswerId === answer.id }]">
          <div class="image">
            <img class="img" :src="answer.image" alt="answer-img" />
          </div>
          <div class="text">
            <p>{{ answer.title }}</p>
            <span>{{ index + 1}}</span>
          </div>
        </div>

      </div>
      </div>
  </div>
</template>


