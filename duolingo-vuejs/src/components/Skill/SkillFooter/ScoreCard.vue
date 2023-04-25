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
        backgroundColorFalse : { backgroundColor : '#d7ffb9', color : '#EA2B2B'},
        textColorFalse : { color : '#EA2B2B'},
        isShowResult : false
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
            <div v-for="item in this.fixedQuestionsData" class="scorecard-box" v-bind:style="item.result === false || item.result === 'Skipped' ? backgroundColorFalse : backgroundColorTrue">
                <div class="title">
                    <p>{{ item.question.title }}</p>
                    <font-awesome-icon class="result-icon" :icon="item.result === false || item.result === 'Skipped' ? ['fas', 'circle-xmark'] : ['fas', 'circle-check']" />
                </div>

                <div class="answer">
                    <p>{{ item.question.answer === 'Completed' ? item.answers.map(item => item.title.split("/")[1]).join(", ") : item.question.title !== 'Read this sentence' ? item.question.answer : '' }}</p>
                    <img v-if="item.question.audio !== ''" class="speaker-icon" src="/src/assets/img/addition/speaker.png" alt="speaker">
                </div>

                <div v-if="isShowResult" class="result">
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

<style scoped>
#scorecard {
    z-index: 1;
    padding: 60px;
    background-color: rgba(53, 53, 53, 0.8);
    backdrop-filter: blur(1px);
    width: 100vw;
    height: 100vh;
}

#scorecard #container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: white;
    border: 1px solid #cfcfcf;
    border-radius: 14px;
    width: fit-content;
    max-width: 766px;
    margin: 0px auto;
    padding: 20px;
}

#scorecard #container #close-button {
    position: absolute;
    right: -16px;
    top: -16px;
    border-radius: 16px;
    border: solid 1px #666;
    background-color: #fff;
}

#scorecard #container #close-button:hover {
    cursor: pointer;
    background-color: #e2e2e2;
}

#scorecard #container #close-button #btn {
    font-size: 22px;
    color: #b1b1b1;
    padding: 3px 8px;
}

#scorecard #container #header-text {
    text-align: center;
}

#scorecard #container #header-text p {
    color: #999999;
    font-size: 24px;
    margin-bottom: 34px;
}

#scorecard #scorecard-board {
    display: flex;
    flex-wrap: wrap;
}

#scorecard #scorecard-board .scorecard-box {
    margin: 8px;
    padding: 12px;
    border-radius: 14px;
    position: relative;
    width: 165px;
    height: 150px;
}

#scorecard #scorecard-board .scorecard-box:hover {
    cursor: pointer;
}

#scorecard #scorecard-board .scorecard-box .title {
    display: flex;
    justify-content: space-between;
    margin-bottom: 6px;
}

#scorecard #scorecard-board .scorecard-box .title .result-icon {
    font-size: 24px;
}

#scorecard #scorecard-board .scorecard-box .title p {
    width: 100px;
    font-weight: bolder;
}

#scorecard #scorecard-board .scorecard-box .answer img {
    width: 39px;
    height: fit-content;
    border-radius: 20px;
    z-index: 1;
}

#scorecard #scorecard-board .scorecard-box .result {
    position: absolute;
    width: max-content;
    left: 50%;
    top: 90%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 12px;
    border-radius: 12px;
    border: solid 1px #E5E5E5;
    height: 136px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

#scorecard #scorecard-board .scorecard-box .result p {
    color: #999999;
    font-weight: bolder;
}

#scorecard #scorecard-board .scorecard-box .result span {
    color: black;
}


</style>