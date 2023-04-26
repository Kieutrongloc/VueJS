<script>
export default {
  name: 'WordLinking',
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
      selectedQuestionId : null,
      selectedQuestion : null,
      questionData : [],
      answerData : [],
      matchedQuestions : [],
      matchedAnswers : [],
      buttonStyleOnCheck : null,
      textStyleOnCheck : null,
      matchedButtonStyle : { cursor : 'default', borderColor : '#e5e5e5', color : '#e5e5e5'},
      matchedTextStyle : { color : '#e5e5e5' },
      defaultButtonStyle : {},
      answerId: 1,
    };
  },

  watch: {
    currentQuestion: {
      immediate: true,
      handler(newVal) {
        this.selectedAnswerId = null,
        this.selectedAnswer = null,
        this.selectedQuestionId = null,
        this.selectedQuestion = null,
        this.questionData = [],
        this.answerData = [],
        this.matchedQuestions = [],
        this.matchedAnswers = []
      }
    },
  },
  
  async created() {
    while ((this.currentQuestionData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }

    this.questionData = this.currentQuestionData.question.description.split(' ');
    this.answerData = this.currentQuestionData.answers.map(answer => {
      const [englishWord, vietnameseWord] = answer.title.split('/');
      return { englishWord, vietnameseWord };
    });

  },

  methods: {
    selectQuestion(index, question) {
      this.selectedQuestionId = index
      this.selectedQuestion = question
      if(this.selectedAnswer !== null) {this.pairCheck()}
    },

    selectAnswer(answer) {
      new Audio(answer.audio).play()
      this.selectedAnswerId = answer.id
      this.selectedAnswer = answer.title.split('/')[0];
      if(this.selectedQuestion !== null) {this.pairCheck()}

    },

    pairCheck() {
      if (this.selectedQuestion === this.selectedAnswer) {
        this.matchedQuestions.push(this.selectedQuestionId);
        this.matchedAnswers.push(this.selectedAnswerId);
        this.selectedQuestion = this.selectedAnswer  = null;
        this.buttonStyleOnCheck = { borderColor : '#58cc02' , backgroundColor : '#D8F2D8' };
        this.textStyleOnCheck = {color : '#58cc02'};
        setTimeout(() => {
          this.selectedQuestionId = this.selectedAnswerId = this.buttonStyleOnCheck = this.textStyleOnCheck = null;
        }, 300);
      } else {
        this.selectedQuestion = this.selectedAnswer = null;
        this.buttonStyleOnCheck = {borderColor : '#D79F9F' , backgroundColor : '#F2D8D8'},
        this.textStyleOnCheck = {color : '#e86f6f' };
        setTimeout(() => {
          this.selectedQuestionId = this.selectedAnswerId = this.buttonStyleOnCheck = this.textStyleOnCheck = null;
        }, 500);
      }

      if (this.matchedAnswers.length === this.currentQuestionData.answers.length && this.matchedQuestions.length === this.currentQuestionData.answers.length)
      {
        this.answerId = this.answerId + 1
        this.$emit('select-answer', this.answerId , 'completed');
      }
    }
  }
};
</script>

<template>
  <div id="word-link">
    <!-- Template word linking  -->
    <div class="question-template" id="template-word-linking">
        <h1 class="question">{{ currentQuestionData.question.title }}</h1>

        <div id="answer-area">

          <div class="question-list">
            <button :class="['question-box', { 'selected-question' : selectedQuestionId === index}]" :style="selectedQuestionId === index ? buttonStyleOnCheck : matchedQuestions.includes(index) ? matchedButtonStyle : {}" v-for="(question, index) in currentQuestionData.question.description.split(' ')" @click="selectQuestion(index, question)" :disabled="matchedQuestions.includes(index)">
              <div class="text">
                <span :style="selectedQuestionId === index ? buttonStyleOnCheck : matchedQuestions.includes(index) ? matchedButtonStyle : {}">{{ index + 1 }}</span>
                <p :style="selectedQuestionId === index ? textStyleOnCheck : matchedQuestions.includes(index) ? matchedTextStyle : {}">{{ question }}</p>
              </div>
            </button>
          </div>
  
          <div class="answer-list">
            <button :class="['answer-box', { 'selected-answer': selectedAnswerId === answer.id }]" :style="selectedAnswerId === answer.id ? buttonStyleOnCheck : matchedAnswers.includes(answer.id) ? matchedButtonStyle : {}" v-for="(answer, index) in currentQuestionData.answers" :key="answer.id" @click="selectAnswer(answer)" :disabled="matchedAnswers.includes(answer.id)">
              <div class="text">
                <span :style="selectedAnswerId === answer.id ? buttonStyleOnCheck : matchedAnswers.includes(answer.id) ? matchedButtonStyle : {}">{{ index + 1 }}</span>
                <p :style="selectedAnswerId === answer.id ? textStyleOnCheck : matchedAnswers.includes(answer.id) ? matchedTextStyle : {}">{{ answer.title.split('/')[1] }}</p>
              </div>
            </button>
          </div>

        </div>

      </div>
  </div>
</template>