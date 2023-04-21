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
      selectedAnswerId : null,
      selectedAnswer : null,
    };
  },

  watch: {
    currentQuestionData: {
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



<style scoped>
#text-selecting {
  height: 100%;
  display: flex;
  justify-content: center;
}

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

.answer-box:hover {
  cursor: pointer;
  background-color: #f4f4f4;
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
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 5px 2px;
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

.selected-answer {
  background-color: #ddf3ff;
  border-color: #84d8ff!important;
  border-width: 2px 2px 5px 2px!important;
}

.selected-answer:hover {
  background-color: #ddf3ff;
}

.text span {
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  width: 22px;
  text-align: center;
  border-radius: 8px;
}
</style>