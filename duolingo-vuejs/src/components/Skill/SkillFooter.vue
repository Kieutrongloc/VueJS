<script>
import ScoreCard from './SkillFooter/ScoreCard.vue';
import router from '../../router'

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

  components: {
    ScoreCard
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
      isScoreCard : false
    };
  },

  emits: ['next-question','disable-click', 'summation-section', 'answer-validate', 'missed-questions-section', 'select-answer', 'ending-section', 'disable-header'],

  watch: {
    currentQuestion(newVal) {
      if (newVal === this.fixedQuestionsData.length - 1) {
        this.isMissedQuestionsSection = true;
      }
      
    },

    answerId() {
      if (this.selectAnswerTitle !=='') {
        this.isButtonDisable = false;
        this.buttonStyle = { color: '#fff', backgroundColor : '#58cc03', cursor: 'pointer', borderColor: '#58a700', borderWidth: '0px 0px 4px 0px'};
        if(this.selectAnswerTitle === 'completed') {
        this.handleTrue();
        this.handleScorecard('Completed');
        this.isResultShow = true;
        }
      } else {
        this.isButtonDisable = true;
        this.buttonStyle = { color: '#A3A3A3', backgroundColor : '#fff', cursor: 'default', borderColor: '#bababa', borderWidth: '2px 2px 4px 2px'}
      }
    },
  },

  methods: {
    handleCheck() {
    this.isResultShow = true;
    this.$emit('disable-click', true);
    if(this.selectAnswerTitle.toLowerCase().replace(/[\s/]/g, '') === this.questionsData[this.currentQuestion].question.answer.toLowerCase().replace(/ /g, '').replace(/\//g, '')) {
      this.handleScorecard(true);
      this.handleTrue()
    } else {
      this.handleScorecard(false);
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
      this.$emit('disable-click', false);
      if (this.currentQuestion < this.questionsData.length && this.isEndingSection === false) {
        this.backgroundStyle = { backgroundColor : '#fff' };
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
      } else {
      this.$emit('ending-section',  this.isEndingSection, this.endingSectionTemplate++);
      if(this.endingSectionTemplate === 2) {router.push('/user-home')}
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
      this.$emit('disable-header', true);
      this.checkButtonText = 'CONTINUE';
    },

    handleSkip() {
      this.handleFalse();
      this.isButtonDisable = false;
      this.isResultShow = true;
      this.$emit('disable-click', true);
      this.handleScorecard('Skipped');
    },

    handleScorecard(result) {
      if(this.currentQuestion < this.fixedQuestionsData.length) {
        result === 'Skipped' ?
        this.fixedQuestionsData[this.currentQuestion] = {...this.fixedQuestionsData[this.currentQuestion], result: 'Skipped', userAnswer: null} :
        result === 'Completed' ?
        this.fixedQuestionsData[this.currentQuestion] = {...this.fixedQuestionsData[this.currentQuestion], result: 'Completed', userAnswer: 'Completed'} :
        this.fixedQuestionsData[this.currentQuestion] = {...this.fixedQuestionsData[this.currentQuestion], result: result, userAnswer: this.selectAnswerTitle};
      }
    },

    handleReviewLesson() {
      this.isScoreCard = !this.isScoreCard;
    },

    playAudio(audio) {
      audio.play();
    },

    handleCloseScorecard(isValue) {
      this.isScoreCard = isValue
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
  <div id="skillfooter-container" v-bind:style="backgroundStyle">
    <section>
      <button v-if="!isResultShow" @click="skipButtonText === 'SKIP' ? handleSkip() : handleReviewLesson()">{{ skipButtonText }}</button>

      <div v-if="isResultShow" id="result" :class="{'invisible' : !isSummationSection && (trueInRow === 5 || trueInRow === 10)}">
        <font-awesome-icon id="result-icon" v-bind:style="resultColor" :icon="resultMessage === 'CORRECT' ? ['fas', 'circle-check'] : ['fas', 'circle-xmark']" />
        <div>
          <p v-bind:style="resultColor">{{ resultMessage }}</p>
          <span v-if="resultMessage !== 'CORRECT' && selectAnswerTitle !== 'Completed'" v-bind:style="resultColor">{{ questionsData[currentQuestion].question.answer }}</span>
        </div>
      </div>

      <button v-if="!isSubmit" :disabled="isButtonDisable" v-bind:style="buttonStyle" @click="checkButtonText==='CHECK' ? handleCheck() : checkButtonText==='CONTINUE' ? handleContinue() : handleSubmit()">{{ checkButtonText }}</button>
    </section>

    <div id="score-card" v-if="isScoreCard">
      <ScoreCard :fixedQuestionsData = "fixedQuestionsData" @close-scorecard = 'handleCloseScorecard'></ScoreCard>
    </div>

  </div>
</template>


