<script>
// import { METHOD_TYPES } from '@babel/types';

export default {
  name: 'WordListening',
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
  
  watch: {
    currentQuestion: {
      immediate: true,
      handler(newVal) {
        this.selectedAnswerId = null
      }
    }
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


