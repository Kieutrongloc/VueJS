<script>
export default {
  name: 'SentenceReading',
  props: {
    currentQuestionData: {
      type: Object,
      required: true
    },

    currentQuestion: {
      type: Number,
      required : true
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
        this.selectedAnswerId = null,
        this.selectedAnswer = null,
        this.userAnswer = []
      }
    }
  },
  
  mounted() {
    this.playAudio(),
    // TEST
    this.$emit('select-answer', 1, 'test');
  },

  methods: {
    playAudio() {
      new Audio(this.currentQuestionData.question.audio).play()
    },

    recordHandle() {
      var answerId = 0;
      alert('updating')
    }
  }
};
</script>

<template>
  <div id="sentence-reading">
    <!-- Template list selecting  -->
    <div class="question-template" id="template-sentence-reading">
        <h1 class="question"> {{ currentQuestionData.question.title }}</h1>
        <div class="answer-list">
          <div class="question-detail">
            <div class="question-detail-img">
              <img :src="currentQuestionData.question.image" alt="question-img" />
            </div>
            <div class="question-detail-des">
              <div>
                <div @click="playAudio()">
                  <font-awesome-icon class="audio-icon" :icon="['fas', 'volume-high']"/>
                </div>
              </div>
              <p>{{ currentQuestionData.question.description }}</p>
            </div>
          </div>

          <div class="answer-area">
            <div @click="recordHandle" id="record-button">
              <font-awesome-icon class="microphone-icon" :icon="['fas', 'microphone']" />
              <p>CLICK TO SPEAK</p>
            </div>
          </div>
        </div>
    </div>
  </div>
</template>