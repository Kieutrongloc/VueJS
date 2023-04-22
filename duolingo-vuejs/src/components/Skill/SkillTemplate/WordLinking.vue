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
      defaultButtonStyle : {}
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
      {this.$emit('select-answer', 1 , 'completed');}
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



<style scoped>

#word-link {
  height: 100%;
  display: flex;
  justify-content: center;
}

#word-link .question-template {
  width: 620px;
  min-height: 400px;
  max-height: 88%;
  height: 460px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin: auto;
}

#word-link .question-template h1 {
  font-size: 36px;
  font-weight: bolder;
  color: #3c3c3c;
}

#word-link #answer-area {
  display: flex;
  justify-content: space-around;
}

#word-link .question-template #answer-area .question-list .question-box:hover,
#word-link .question-template #answer-area .answer-list .answer-box:hover {
  cursor: pointer;
}
#word-link .question-template #answer-area .question-list,
#word-link .question-template #answer-area .answer-list {
  display: flex;
  flex-direction: column;
}
#word-link .question-template #answer-area .question-list .question-box,
#word-link .question-template #answer-area .answer-list .answer-box {
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 5px 2px;
  width: 240px;
  margin: 4px auto;
  border-radius: 18px;
  background-color: #fff;
}
#word-link .question-template #answer-area .question-list .question-box .text,
#word-link .question-template #answer-area .answer-list .answer-box .text {
  display: flex;
  margin: 12px;
}

#word-link .question-template #answer-area .question-list .question-box .text p,
#word-link .question-template #answer-area .answer-list .answer-box .text p {
  width: 100%;
  text-align: center;
  font-size: larger;
  color: #6c6c6c;
  font-weight: bolder;
}

#word-link .question-template #answer-area .question-list .selected-question,
#word-link .question-template #answer-area .answer-list .selected-answer {
  background-color: #ddf3ff;
  border-color: #84d8ff;
  border-width: 2px 2px 5px 2px!important;
}

#word-link .question-template #answer-area .question-list .selected-question:hover,

#word-link .question-template #answer-area .answer-list .selected-answer:hover {
  background-color: #ddf3ff;
}

#word-link .question-template #answer-area .question-list .question-box .text span,

#word-link .question-template #answer-area .answer-list .answer-box .text span {
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  width: 30px;
  text-align: center;
  border-radius: 8px;
  font-size: 16px;
  color: #8c8c8c;
  font-weight: bolder;
}
</style>