<script>
// import { METHOD_TYPES } from '@babel/types';

export default {
  name: 'ImageSelecting',
  props: {
    currentQuestionData: {
      type: Object,
      required: true
    },
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
    currentQuestionData: {
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

/* template-image-selecting */
#template-image-selecting .answer-list {
  flex-direction: row;
  justify-content: center;
  align-items: center;
}

#template-image-selecting .answer-list .answer-box {
  margin: 0px auto;
  /* border: 2px solid #bababa;
  border-bottom: 7px; */
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  width: 200px;
  height: 314px;
  border-radius: 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
}

.answer-box:hover {
  cursor: pointer;
  background-color: #f4f4f4;
}

#template-image-selecting .answer-list .answer-box .image {
  height: 160px;
  width: 140px;
  margin: 0px auto;
}

#template-image-selecting .answer-list .answer-box .image img {
  height: 160px;
  width: 140px;
}
#template-image-selecting .answer-list .answer-box .text {
  display: flex;
  justify-content: space-between;
  width: 180px;
  margin: 0px auto;
}

#template-image-selecting .answer-list .answer-box .text p {
  font-size: 18px;
}

.text span {
  color: #8a8a8a;
  font-weight: bolder;
  font-size: 16px;
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  padding: 2px;
  width: 30px;
  border-radius: 8px;
  text-align: center;
}

.selected-answer {
  background-color: #ddf3ff;
  border-color: #84d8ff!important;
  border-width: 2px 2px 4px 2px!important;
}

.selected-answer:hover {
  background-color: #ddf3ff;
}

</style>


