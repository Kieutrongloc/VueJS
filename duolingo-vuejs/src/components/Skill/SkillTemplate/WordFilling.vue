<script>
export default {
  name: 'WordFilling',
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

  watch: {
    currentQuestion: {
      immediate: true,
      handler(newVal) {
        this.newSentence = this.currentQuestionData.answers[0].title.split(" ")
        this.userAnswer = []
      }
    }
  },

  data() {
    return {
      selectedAnswerId : null,
      selectedAnswer : null,
      userAnswer : [],
      missingIndex : null,
      answerId : 0,
      newSentence : null
    };
  },

  computed: {

  },
  
  async created() {
    while ((this.currentQuestionData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    };
  },

  methods: {
    answerHandle(index) {
      this.answerId++;
      this.$emit('select-answer', this.answerId, Object.values(this.userAnswer).join('/'));
    }
  }
};
</script>

<template>
  <div id="word-filling">
    <!-- Template word filling  -->
    <div class="question-template" id="template-word-filling">
        <h1 class="question"> {{ currentQuestionData.question.title }}</h1>
        <div class="answer-list">
          <div class="question-detail">
            <div class="question-detail-img">
              <img :src="currentQuestionData.question.image" alt="question-img" />
            </div>
            <div class="question-detail-des">
              <p>{{ currentQuestionData.question.description }}</p>
            </div>
          </div>

          <div id="answer-box">
            <div class="answer-area">
              
              <div class="text" v-for="(word, index) in newSentence" :key="index">
                <div>
                  
                  <div v-if="word !== '...'">
                    <p>{{ word }}</p>
                  </div>
  
                  <div v-else>
                    <input v-model="userAnswer[index]" type="text" @input ="answerHandle(index)">
                  </div>
  
                </div>
              </div>
    
            </div>
          </div>
        </div>
    </div>
  </div>
</template>