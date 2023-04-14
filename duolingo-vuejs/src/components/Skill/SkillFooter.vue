<script>
// import { is } from '@babel/types';

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
      type: Array,
      required: false
    },
    selectAnswerId: {
      type: Array,
      required: false
    },
  },

  emits: ['select-answer'],
  watch: {
    selectAnswerId() {
      this.isButtonDisable = false;
      this.buttonStyle = { color: '#fff', backgroundColor : '#58cc03', cursor: 'pointer'};
    },
  },
  
  data() {
    return {
      isSubmit: false,
      checkButtonText: 'CHECK',
      isButtonDisable : true,
      backgroundStyle : null,
      isResultShow : false,
      resultMessage : null,
      resultColor : null,
    };
  },

  methods: {
    handleCheck() {
    this.isResultShow = true;
    if(this.selectAnswerTitle.toLowerCase().replace(/\s/g,'') === this.questionsData[this.currentQuestion].question.q_answer.toLowerCase().replace(/\s/g,'')) {
      // if true
      this.playAudio(new Audio('/src/assets/audio/addition/audio-true.mp3'))
      this.backgroundStyle = { backgroundColor : '#d7ffb9' }
      this.resultMessage = 'CORRECT'
      this.resultColor = { color: '#58a700'};
    } else {
      // if false
      this.playAudio(new Audio('/src/assets/audio/addition/audio-false.mp3'))
      this.backgroundStyle = { backgroundColor : '#ffdfe0' };
      this.resultMessage = 'CORRECT SOLUTION:';
      this.resultColor = { color: '#ec0c1c'};
      this.buttonStyle = { color: '#fff', backgroundColor : '#ec0c1c'}
    }
    if (this.currentQuestion !== this.questionsData.length - 1) {
      this.checkButtonText = 'CONTINUE';
    } else {
      this.checkButtonText = 'SUBMIT';
    }
    },

    handleContinue() {
      this.$emit('next-question', this.currentQuestion + 1);
      this.checkButtonText = 'CHECK';
      this.backgroundStyle = { backgroundColor : '#fff' };
      this.buttonStyle = { color: '#A3A3A3', backgroundColor : '#fff', cursor: 'default'}
      this.isResultShow = false;
      this.isButtonDisable = true
    },

    handleSubmit() {

    },

    playAudio(audio) {
      audio.play()
    }
  },
  computed: {

  },
  mounted() {

  }

};
</script>

<template>
  <div id="container" v-bind:style="backgroundStyle">
    <content>
      <button v-if="!isResultShow" @click="">SKIP</button>

      <div v-if="isResultShow" id="result">
        <font-awesome-icon id="result-icon" v-bind:style="resultColor" :icon="resultMessage === 'CORRECT' ? ['fas', 'circle-check'] : ['fas', 'circle-xmark']" />
        <div>
          <p v-bind:style="resultColor">{{ resultMessage }}</p>
          <span v-if="resultMessage !== 'CORRECT'" v-bind:style="resultColor">{{ questionsData[currentQuestion].question.q_answer }}</span>
        </div>
      </div>

      <button v-if="!isSubmit" :disabled="isButtonDisable" v-bind:style="buttonStyle" @click="checkButtonText==='CHECK' ? handleCheck() : checkButtonText==='CONTINUE' ? handleContinue() : handleSubmit()">{{ checkButtonText }}</button>
    </content>
  </div>
</template>


<style scoped>
#container {
  max-height: 140px;
  border-top: 2px solid #e5e5e5 ;
}

#container content {
  width: 1000px;
  min-width: 670px;
  margin: auto;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  flex-direction: row;
}

#container content button {
  width: 150px;
  height: 48px;
  background-color: #fff;
  border-radius: 12px;
  border: solid 2px #e5e5e5;
  font-size: 18px;
  color: #a3a3a3;
  font-weight: bolder;
  margin: 6.99px 0px;
}

#container content #result {
  display: flex;
  justify-content: center;
  align-items: center;
}

#container content #result div {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

#container content #result #result-icon {
  font-size: 50px;
  margin-right: 10px;
}

#container content #result p {
  font-size: 22px;
  font-weight: bolder;
}

#container content #result span {
  font-size: 18px;
}

#container content button:nth-of-type(1):hover {
  cursor: pointer;
  background-color: #d8d8d8;
}

</style>


