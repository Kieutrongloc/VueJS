<script>
export default {
  name: 'SentenceReading',
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

  watch: {
    currentQuestionData: {
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
      // this.$emit('select-answer', answerId, finalAnswer);
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



<style scoped>

#sentence-reading {
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

.question-template .answer-list {
  display: flex;
}

/* Template list selecting  */
#template-sentence-reading .answer-list {
  display: flex;
  flex-direction: column;
  margin-bottom: 30px;
}

#template-sentence-reading .answer-list .question-detail {
  display: flex;
  flex-direction: row;
  align-items: center;
}

#template-sentence-reading .answer-list .question-detail .question-detail-img {
  height: 169px;
  width: 114px;
}

#template-sentence-reading .answer-list .question-detail .question-detail-img img {
  height: 169px;
  width: 110px;
}

#template-sentence-reading .answer-list .question-detail .question-detail-des {
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

#template-sentence-reading .answer-list .answer-area {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  height: 70px;
  border-radius: 14px;
  margin-bottom: 80px;
}

.answer-area #record-button {
  display: flex;
  align-items: center;
}

.answer-area #record-button:hover {
  cursor: pointer;
}

.answer-area .microphone-icon {
  font-size: 28px;
  color: #1cb0f6;
  margin-right: 8px;
}

.answer-area p {
  color: #1cb0f6;
  font-size: 18px;
  font-weight: bolder;
}

</style>