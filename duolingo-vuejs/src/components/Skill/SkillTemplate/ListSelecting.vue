<script>
export default {
  name: 'ListSelecting',
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
    };
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

audio {
  display: none;
}

.question-template .answer-list {
  display: flex;
}

/* Template list selecting  */
#template-list-selecting .answer-list {
  display: flex;
  flex-direction: column;
  margin-bottom: 30px;
}

#template-list-selecting .answer-list .question-detail {
  display: flex;
  flex-direction: row;
  align-items: center;
}

#template-list-selecting .answer-list .question-detail .question-detail-img {
  height: 169px;
  width: 114px;
}

#template-list-selecting .answer-list .question-detail .question-detail-img img {
  height: 169px;
  width: 110px;
}

#template-list-selecting .answer-list .question-detail .question-detail-des {
  margin-left: 10px;
  display: flex;
  align-items: center;
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  border-radius: 14px;
  padding: 4px;
}

.audio-icon {
  color: #1cb0f6;
  height: 26px;
  margin: 6px;
}

.audio-icon:hover {
  cursor: pointer;
}

#template-list-selecting .answer-list .user-answer {
  display: flex;
  flex-direction: row;
  border-top: solid 2px #c8c8c8;
  height: 60px;
  border-bottom: solid 2px #c8c8c8;
  margin-bottom: 40px;
  justify-content: center;

}

#template-list-selecting .answer-list .answer-area {
  display: flex;
  flex-direction: row;
  justify-content: center;
  flex-wrap: wrap;
}

#template-list-selecting .answer-list .answer-area .answer-box {
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  border-radius: 10px;
  padding: 8px 6px;
  margin: 2px;
  min-width: 60px;
  width: fit-content;
  display: flex;
  justify-content: center;
  background-color: #fff;
}

/* update css */

#template-list-selecting .answer-list .user-answer {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-content: center;
  flex-wrap: wrap;
  height: 60px;
}
.selected-answer {
  visibility: hidden;
}

.answer-box:hover,
.user-answer-box:hover {
  cursor: pointer;
  background-color: #f4f4f4;
}

#template-list-selecting .answer-list .user-answer .user-answer-box {
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  border-radius: 10px;
  padding: 8px 6px;
  margin: 2px;
  min-width: 60px;
  width: fit-content;
  display: flex;
  justify-content: center;
  height: 42px;
  margin: 6.5px 2px;
  align-items: center;
}

.box-background {
  background-color: #cacaca;
  border-radius: 10px;
  margin: 2px;
  width: 60px;
  height: 46px;
  position: absolute;
  top: 0px;
  z-index: -2;
}

</style>