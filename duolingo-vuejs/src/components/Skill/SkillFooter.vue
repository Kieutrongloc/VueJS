<script>

export default {
  props: {
    questionsData: {
      type: Array,
      required: true
    },
    currentQuestion: {
      type: Number,
      required: true
    },
    selectAnswerTitle: {
      required: true
    },
    selectAnswerId: {
      required: true
    },
  },

  emits: ['next-question','disable-click', 'summation-section', 'answer-validate', 'missed-questions-section', 'select-answer', 'ending-section'],

  watch: {
    currentQuestion(newVal) {
      if (newVal === this.fixedQuestionsData.length - 1) {
        this.isMissedQuestionsSection = true
      }
    },

    answerId() {
      if (this.selectAnswerTitle !=='') {
        this.isButtonDisable = false;
        this.buttonStyle = { color: '#fff', backgroundColor : '#58cc03', cursor: 'pointer', borderColor: '#58a700', borderWidth: '0px 0px 4px 0px'};
      } else {
        this.isButtonDisable = true;
        this.buttonStyle = { color: '#A3A3A3', backgroundColor : '#fff', cursor: 'default', borderColor: '#bababa', borderWidth: '2px 2px 4px 2px'}
      }
    },
  },

  
  data() {
    return {
      isSubmit: false,
      skipButtonText : 'SKIP',
      checkButtonText: 'CHECK',
      isButtonDisable : true,
      backgroundStyle : { color: 'white'},
      isResultShow : false,
      resultMessage : null,
      resultColor : null,
      buttonStyle : null,
      trueInRow : 0,
      isSummationSection : true,
      fixedQuestionsData : [],
      isMissedQuestionsSection : false,
      isEndingSection : false,
      endingSectionTemplate : 1,
    };
  },

  methods: {
    handleCheck() {
    this.isResultShow = true;
    this.$emit('disable-click', true);
    if(this.selectAnswerTitle.toLowerCase().replace(/\s/g,'') === this.questionsData[this.currentQuestion].question.answer.toLowerCase().replace(/ /g, '').replace(/\//g, '')) {
      this.handleTrue()
    } else {
      this.handleFalse()
    }
    },

    handleTrue() {
      this.playAudio(new Audio('/src/assets/audio/addition/audio-true.mp3'));
      this.backgroundStyle = { backgroundColor : '#d7ffb9' }
      this.resultColor = { color: '#58a700'};
      this.$emit('answer-validate', this.currentQuestion, true);
      if (this.currentQuestion !== this.questionsData.length - 1) {
        this.resultMessage = 'CORRECT'
        this.checkButtonText = 'CONTINUE';
        this.trueInRow++;
      } else {
        this.checkButtonText = 'SUBMIT';
      }
    },

    handleFalse() {
      this.playAudio(new Audio('/src/assets/audio/addition/audio-false.mp3'));
      this.backgroundStyle = { backgroundColor : '#ffdfe0' };
      this.resultMessage = 'CORRECT SOLUTION:';
      this.resultColor = { color: '#ec0c1c'};
      this.buttonStyle = { color: '#fff', backgroundColor : '#ec0c1c', borderColor: '#ea2a2b', borderWidth: '0px 0px 4px 0px'}
      this.checkButtonText = 'CONTINUE';
      this.trueInRow = 0;
      this.$emit('answer-validate', this.currentQuestion, false);
    },
    
    handleContinue() {
      this.backgroundStyle = { backgroundColor : '#fff' };
      this.$emit('disable-click', false);
      this.answerId = 0;
      if(this.isSummationSection === true && (this.trueInRow === 5 || this.trueInRow === 10)) {
        this.$emit('summation-section', this.trueInRow, this.isSummationSection);
        this.isSummationSection = false;
      } else if (this.isMissedQuestionsSection === true) {
        this.$emit('missed-questions-section', this.isMissedQuestionsSection);
        this.isMissedQuestionsSection = !this.isMissedQuestionsSection
      } else {
        this.$emit('next-question', this.currentQuestion + 1);
        this.checkButtonText = 'CHECK';
        this.buttonStyle = { color: '#A3A3A3', backgroundColor : '#fff', cursor: 'default', borderColor: '#bababa', borderWidth: '2px 2px 4px 2px' };
        this.isButtonDisable = true;
        this.isResultShow = false;
        this.isSummationSection = true
      }
    },

    handleSubmit() {
      this.$emit('disable-click', false);
      this.isEndingSection = !this.isEndingSection
      this.$emit('ending-section',  this.isEndingSection, this.endingSectionTemplate);
      this.isResultShow = false;
      this.backgroundStyle = { backgroundColor : '#fff' };
      this.skipButtonText = 'REVIEW LESSON'
      this.playAudio(new Audio('/src/assets/audio/addition/audio-ending.mp3'));
    },

    handleSkip() {
      this.handleFalse();
      this.isButtonDisable = false;
      this.isResultShow = true;
      this.$emit('disable-click', true);
    },

    handleReviewLesson() {
      alert('catched')
    },

    playAudio(audio) {
      audio.play()
    }
  },

  computed: {
    answerId() {
      return this.selectAnswerId;
    }
  },

  mounted() {
    this.fixedQuestionsData = [...this.questionsData];
  }

};
</script>

<template>
  <div id="container" v-bind:style="backgroundStyle">
    <section>
      <button v-if="!isResultShow" @click="skipButtonText === 'SKIP' ? handleSkip() : handleReviewLesson()">{{ skipButtonText }}</button>

      <div v-if="isResultShow" id="result" :class="{'invisible' : !isSummationSection && (trueInRow === 5 || trueInRow === 10)}">
        <font-awesome-icon id="result-icon" v-bind:style="resultColor" :icon="resultMessage === 'CORRECT' ? ['fas', 'circle-check'] : ['fas', 'circle-xmark']" />
        <div>
          <p v-bind:style="resultColor">{{ resultMessage }}</p>
          <span v-if="resultMessage !== 'CORRECT'" v-bind:style="resultColor">{{ questionsData[currentQuestion].question.answer }}</span>
        </div>
      </div>

      <button v-if="!isSubmit" :disabled="isButtonDisable" v-bind:style="buttonStyle" @click="checkButtonText==='CHECK' ? handleCheck() : checkButtonText==='CONTINUE' ? handleContinue() : handleSubmit()">{{ checkButtonText }}</button>
    </section>
  </div>
</template>


<style scoped>
#container {
  max-height: 140px;
  border-top: 2px solid #e5e5e5 ;
}

#container section {
  width: 1000px;
  min-width: 670px;
  margin: auto;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  flex-direction: row;
}

#container section button {
  width: 150px;
  min-width: fit-content;
  height: 48px;
  background-color: #fff;
  border-radius: 12px;
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  font-size: 18px;
  color: #a3a3a3;
  font-weight: bolder;
  margin: 6.99px 0px;
}

#container section #result {
  display: flex;
  justify-content: center;
  align-items: center;
}

#container section #result div {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

#container section #result #result-icon {
  font-size: 50px;
  margin-right: 10px;
}

#container section #result p {
  font-size: 22px;
  font-weight: bolder;
}

#container section #result span {
  font-size: 18px;
}

#container section button:nth-of-type(1):hover {
  cursor: pointer;
  background-color: #d8d8d8;
}

.invisible {
  visibility: hidden;
}
</style>


