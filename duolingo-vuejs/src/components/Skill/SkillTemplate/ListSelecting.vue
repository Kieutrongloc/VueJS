<script>
export default {
  name: 'ListSelecting',
  props: {
    currentQuestionData: {
      type: Object,
      required: true
    },

    currentQuestion: {
      type: Number,
      required: true
    }
  },

  data() {
    return {
      selectedAnswerId : null,
      selectedAnswer : null,
      userAnswer : [],
    };
  },

  watch: {
    currentQuestion: {
      immediate: true,
      handler(newVal) {
        this.currentQuestionData.answers.forEach((item) => {item.hidden=false});
        this.selectedAnswerId = null,
        this.selectedAnswer = null,
        this.userAnswer = []
      }
    }
  },
  
  mounted() {
    this.replayQuestion()
  },

  methods: {
    replayQuestion() {
      new Audio(this.currentQuestionData.question.audio).play()
    },

    selectAnswer(index, answer) {
      new Audio(answer.audio).play()
      this.selectedAnswerId = answer.id
      this.selectedAnswer = answer.title
      this.userAnswer.push(this.currentQuestionData.answers[index]);
      this.hideItem(index)
      this.finalAnswerHandle()
    },

    removeAnswer(index, answer) {
      this.userAnswer.splice(index, 1);
      this.currentQuestionData.answers.forEach((item) => {if(item.id===answer.id) {item.hidden=false}})
      this.finalAnswerHandle()
    },

    hideItem(index) {
      this.currentQuestionData.answers[index].hidden = true
    },

    finalAnswerHandle() {
      var finalAnswer = '';
      var answerId = 1;
      this.userAnswer.forEach((answer) => {
        finalAnswer += (answer.title + ' ');
        answerId++
      })
      this.$emit('select-answer', answerId, finalAnswer.trim());
    }
  }
};
</script>

<template>
  <div id="list-selecting">
    <!-- Template list selecting  -->
    <div class="question-template" id="template-list-selecting">
        <h1 class="question"> {{ currentQuestionData.question.title }}</h1>
        <div class="answer-list">
          <div class="question-detail">
            <div class="question-detail-img">
              <img :src="currentQuestionData.question.image" alt="question-img" />
            </div>
            <div class="question-detail-des">
              <div>
                <div @click="replayQuestion()">
                  <font-awesome-icon class="audio-icon" :icon="['fas', 'volume-high']"/>
                </div>
              </div>
              <p>{{ currentQuestionData.question.description }}</p>
            </div>
          </div>

          <div class="user-answer">
            <div :class="['user-answer-box', { 'user-selected-answer': selectedAnswer === answer.id }]" v-for="(answer, index) in userAnswer" :key="answer.id" @click="removeAnswer(index, answer)">
              <div class="text answer-box">
                <p>{{ answer.title }}</p>
              </div>
            </div>
          </div>

          <div class="answer-area">

            <div v-for="(answer, index) in currentQuestionData.answers" :key="answer.id">
              <div :class="['answer-box', { 'selected-answer': answer.hidden === true }]"  @click="selectAnswer(index, answer)" class="text">
                <p>{{ answer.title }}</p>
              </div>
              <div class="box-background"></div>
            </div>
  
          </div>
        </div>
    </div>
  </div>
</template>