<script>
export default {
  name: 'ScoreCard',
  props: {
    fixedQuestionsData: {
        type: Object,
        required: true
    }
  },

  data() {
    return {
        backgroundColorTrue : { backgroundColor : '#d7ffb9', color: '#58A700'},
        textColorTrue : { color : '#58A700'},
        backgroundColorFalse : { backgroundColor : '#ffdfe0', color : '#EA2B2B'},
        textColorFalse : { color : '#EA2B2B'},
        isShowResult : false,
        selectedBoxIndex : null
    };
  },

  emits: ['close-scorecard'],

  watch: {

  },
  
  mounted() {
  },

  methods: {
    closeScoreCard() {
        this.$emit('close-scorecard', false);
    },

    selectBoxHandle(index) {
        this.isShowResult = !this.isShowResult
        this.selectedBoxIndex = index
    },

    playAudio(audio) {
        new Audio(audio).play()
    }
  }
};
</script>

<template>
  <div id="scorecard">
    <!-- Template score card  -->
    <div id="container">
        <div id="close-button" @click="closeScoreCard">
            <font-awesome-icon id="btn" :icon="['fa', 'xmark']" />
        </div>
        <div id="header-text">
            <h1>Check out your scorecard!</h1>
            <p>Click the tiles below to reveal the solutions</p>
        </div>
        <div id="scorecard-board">
            <div v-for="(item, index) in this.fixedQuestionsData" :key="index" class="scorecard-box" v-bind:style="item.result === false || item.result === 'Skipped' ? backgroundColorFalse : backgroundColorTrue" @click="selectBoxHandle(index)">
                <div class="title">
                    <p>{{ item.question.title }}</p>
                    <font-awesome-icon class="result-icon" :icon="item.result === false || item.result === 'Skipped' ? ['fas', 'circle-xmark'] : ['fas', 'circle-check']" />
                </div>

                <div class="answer">
                    <div v-if="item.question.audio !== ''" @click="playAudio(item.question.audio)">
                        <img class="speaker-icon" src="/src/assets/img/addition/speaker.png" alt="speaker">
                    </div>
                    <p v-else>{{ item.question.answer === 'Completed' ? item.answers.map(item => item.title.split("/")[1]).join(", ") : item.question.title !== 'Read this sentence' ? item.question.answer : '' }}</p>
                </div>

                <div v-if="isShowResult && selectedBoxIndex === index" class="result">
                    <div class="user-response">
                        <p>YOUR RESPONSE:</p>
                        <span>{{ item.userAnswer === "completed" ? item.answers.map(item => `${item.title.replace('/', '⟷')}`).join(', ') : item.userAnswer === null ? 'Skipped' : item.userAnswer }}</span>
                    </div>

                    <div class="correct-result">
                        <p>CORRECT RESPONSE:</p>
                        <span>{{ item.question.answer === "Completed" ? item.answers.map(item => `${item.title.replace('/', '⟷')}`).join(', ') : item.question.title ==="Read this sentence" ? 'SENTENCE READING' : item.question.answer }}</span>
                    </div>

                </div>

            </div>

        </div>
    </div>
  </div>
</template>