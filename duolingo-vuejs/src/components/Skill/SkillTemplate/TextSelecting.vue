<script>
export default {
  name: 'TextSelecting',
  props: {
    currentQuestionData: {
      type: Object,
      required: true
    },
  },
  data() {
    return {
      selectedAnswer : null,
    };
  },
  
  async created() {
    while ((this.currentQuestionData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }
  },

  methods: {
    selectAnswer(answer) {
      (new Audio(`data:audio/mp3;base64,${answer.a_audio}`)).play()
      this.selectedAnswer = answer.a_id
    }
  }
};
</script>

<template>
  <div id="text-selecting">
    <!-- Template text selecting  -->
    <div class="question-template" id="template-text-selecting">
        <h1 class="question">{{ currentQuestionData.question.q_title }}</h1>

        <div class="answer-list">

          <div :class="['answer-box', { 'selected-answer': selectedAnswer === answer.a_id }]" v-for="(answer, index) in currentQuestionData.answers" :key="answer.id" @click="selectAnswer(answer)">
            <div class="text">
              <span>{{ index + 1 }}</span>
              <p>{{ answer.a_title }}</p>
            </div>
            <audio :src="'data:audio/mp3;base64,' + answer.a_audio"></audio>
          </div>

        </div>
      </div>
  </div>
</template>



<style>
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

/* Template text selecting  */
#template-text-selecting .answer-list {
  flex-direction: column;
  margin-bottom: 60px;
}

#template-text-selecting .answer-list .answer-box {
  border: solid 2px #bababa;
  width: 560px;
  margin: 4px auto;
  border-radius: 10px;
}

#template-text-selecting .answer-list .answer-box .text {
  display: flex;
  margin: 12px;
}

#template-text-selecting .answer-list .answer-box .text p {
  width: 100%;
  text-align: center;
}

.selected-answer {
  background-color: #e6e6e6;
}
</style>