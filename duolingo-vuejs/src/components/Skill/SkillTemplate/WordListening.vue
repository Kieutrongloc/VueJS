<script>
// import { METHOD_TYPES } from '@babel/types';

export default {
  name: 'WordListening',
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

    this.playQuestionAudio()
  },

  methods: {
    selectAnswer(answer) {
      this.playAudio(new Audio(answer.audio))
      this.selectedAnswerId = answer.id
      this.selectedAnswer = answer.title
      this.$emit('select-answer',this.selectedAnswerId, this.selectedAnswer);
    },

    playQuestionAudio(){
      this.playAudio(new Audio(this.currentQuestionData.question.audio))
    },

    playAudio(audio) {
      audio.play()
    }
  }
};
</script>

<template>
  <div id="word-listening">
    <!-- Template image selecting -->
    <div class="question-template" id="template-word-listening">
      <h1 class="question">{{ currentQuestionData.question.title }}</h1>

      <div id='answer-area'>

        <div id="question-audio" @click="playQuestionAudio">
          <img src="/src/assets/img/addition/speaker.png" alt="question-audio">
        </div>

        <div class="answer-list">
  
          <div v-for="(answer, index) in currentQuestionData.answers" :key="answer.id" @click="selectAnswer(answer)" :class="['answer-box', { 'selected-answer': selectedAnswerId === answer.id }]">
            <div class="text">
              <span>{{ index + 1}}</span>
              <p>{{ answer.title }}</p>
              <span style="visibility: hidden;"></span>
            </div>
          </div>
  
        </div>
      </div>
      </div>
  </div>
</template>

<style scoped>
#word-listening {
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

.question-template #answer-area {
  display: flex;
  flex-direction: row;
}

.question-template .answer-list {
  display: flex;
}

/* template-word-listening */
#question-audio img {
  width: 152px;
}

#question-audio img:hover {
  cursor: pointer;
}

#template-word-listening .answer-list {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  width: 600px;
  flex-wrap: wrap;
  height: 140px;
}

#template-word-listening .answer-list .answer-box {
  margin: 0px auto;
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  width: 222px;
  height: 56px;
  border-radius: 10px;
  display: flex;
  padding: 4px 10px;
  align-items: center;
}

.answer-box:hover {
  cursor: pointer;
  background-color: #f4f4f4;
}

#template-word-listening .answer-list .answer-box .text {
  display: flex;
  justify-content: space-between;
  width: 180px;
  margin: 0px auto;
}

#template-word-listening .answer-list .answer-box .text p {
  font-size: 18px;
}

.text span {
  color: #8a8a8a;
  font-weight: bolder;
  font-size: 16px;
  border: 2px solid #d2d2d2;
  padding: 2px;
  width: 30px;
  border-radius: 8px;
  text-align: center;
}

.selected-answer {
  background-color: #e6e6e6;
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


