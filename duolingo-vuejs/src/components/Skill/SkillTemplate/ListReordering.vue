<script>
export default {
  name: 'ListReordering',
  props: {
    currentQuestionData: {
      type: Object,
      required: true
    },
  },

  data() {
    return {
      selectedAnswerId : null,
      selectedAnswer : null,
      userAnswer : [],
      answerLength : null,
    };
  },

  async created() {
    while ((this.currentQuestionData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }
    this.answerLength = this.currentQuestionData.answers.length;
  },

  mounted() {
    this.replayQuestion()
  },

  methods: {
    replayQuestion() {
      new Audio(this.currentQuestionData.question.q_audio).play()
    },

    selectAnswer(index, answer) {
      new Audio(`data:audio/mp3;base64,${answer.audio}`).play()
      this.selectedAnswerId = answer.id
      this.selectedAnswer = answer.title
      this.userAnswer.push(this.currentQuestionData.answers[index]);
      this.hideItem(index)
      this.finalAnswerHandle()
    },

    removeAnswer(index, answer) {
      this.userAnswer.splice(index, 1);
      this.currentQuestionData.answers.forEach((item) => {if(item.id===answer.id) {item.hidden=false}})
    },

    hideItem(index) {
      this.currentQuestionData.answers[index].hidden = true
    },

    finalAnswerHandle() {
      var finalAnswer = '';
      var answerId = 0;
      this.userAnswer.forEach((answer) => {
        finalAnswer += answer.title;
        answerId++
      })
      this.$emit('select-answer', answerId, finalAnswer);
    }
  }
};
</script>

<template>
  <div id="list-reordering">
    <!-- Template list selecting  -->
    <div class="question-template" id="template-list-reordering">
        <h1 class="question"> {{ currentQuestionData.question.q_title }}</h1>
        <div class="answer-list">

          <div class="question-detail">
            <div class="question-detail-img">
              <img :src="currentQuestionData.question.q_image" alt="question-img" />
            </div>
            <div class="question-detail-des">
              <div>
                <div @click="replayQuestion()">
                  <font-awesome-icon class="audio-icon" :icon="['fas', 'volume-high']" />
                </div>
              </div>
              <p>{{ currentQuestionData.question.q_description }}</p>
            </div>
          </div>

          <div :class=" answerLength < 10 ? 'user-answer' : 'user-answer-double-line'">
            
            <div :class="['user-answer-box', { 'user-selected-answer': selectedAnswer === answer.id }]" v-for="(answer, index) in userAnswer" :key="answer.id" @click="removeAnswer(index, answer)">
              <div class="text answer-box">
                <p>{{ answer.title }}</p>
              </div>
            </div>
            
            <div class="user-answer-middle-line" v-if="!answerLength < 10"></div>
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

<style scoped>
.question-template {
  width: 620px;
  min-height: 400px;
  max-height: 88%;
  height: 460px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin: auto;
}

.question-template h1 {
  font-size: 36px;
  font-weight: bolder;
  color: #3c3c3c;
}

.question-template .answer-list {
  display: flex;
}

.audio-icon {
  color: #1cb0f6;
  height: 26px;
  margin: 6px;
}

.audio-icon:hover {
  cursor: pointer;
}

/* Template list reordering  */
#template-list-reordering .answer-list {
  display: flex;
  flex-direction: column;
  margin-bottom: 30px;
}

#template-list-reordering .answer-list .question-detail {
  display: flex;
  flex-direction: row;
  align-items: center;
}

#template-list-reordering .answer-list .question-detail .question-detail-img {
  height: 169px;
  width: 114px;
}

#template-list-reordering .answer-list .question-detail .question-detail-img img {
  height: 169px;
  width: 110px;
}

#template-list-reordering .answer-list .question-detail .question-detail-des {
  margin-left: 10px;
  display: flex;
  align-items: center;
  border: solid 2px #c8c8c8;
  border-radius: 8px;
  padding: 4px;
}

#template-list-reordering .answer-list .user-answer {
  display: flex;
  flex-direction: row;
  border-top: solid 2px #c8c8c8;
  height: 56px;
  border-bottom: solid 2px #c8c8c8;
  margin-bottom: 40px;
  justify-content: flex-start;
}

#template-list-reordering .answer-list .user-answer-double-line {
  display: flex;
  flex-direction: row;
  border-top: solid 2px #c8c8c8;
  height: 112px;
  border-bottom: solid 2px #c8c8c8;
  margin-bottom: 40px;
  justify-content: flex-start;
  flex-wrap: wrap;
}

#template-list-reordering .answer-list .user-answer-double-line .user-answer-middle-line {
  border-top: solid 2px #c8c8c8;
  position: absolute;
  width: 100% ;
  top: 55px;
}

.text {
  display: flex;
  align-items: center;
}

#template-list-reordering .answer-list .answer-area {
  display: flex;
  flex-direction: row;
  justify-content: center;
  flex-wrap: wrap;
  height: 60px;
}

#template-list-reordering .answer-list .answer-area .answer-box {
  border: 2px solid #cacaca;
  border-radius: 10px;
  padding: 8px 6px;
  margin: 2px;
  min-width: 60px;
  width: fit-content;
  display: flex;
  justify-content: center;
  height: 42px;
  background-color: #fff;
}

/* update css */
#template-list-reordering .answer-list .user-answer {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-content: center;
  flex-wrap: wrap;
  height: 56px;
}

.user-answer-box {
  border: 2px solid #cacaca;
  border-radius: 10px;
  padding: 8px 6px;
  margin: 2px;
  min-width: 60px;
  width: max-content;
  display: flex;
  justify-content: center;
  height: 42px;
  margin: 6.5px 2px;
}


.answer-box:hover,
.user-answer-box:hover {
  cursor: pointer;
  background-color: #f4f4f4;
}

.selected-answer {
  visibility: hidden;
}

.box-background {
  background-color: #cacaca;
  border-radius: 10px;
  margin: 2px;
  width: 60px;
  height: 42px;
  position: absolute;
  top: 0px;
  z-index: -2;
}

</style>


