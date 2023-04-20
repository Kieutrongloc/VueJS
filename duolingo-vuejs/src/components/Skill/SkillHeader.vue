<script>
import router from '../../router'

export default {
  props: {
    questionsData: {
      type: Array,
      required: true
    },
    trueAnswerTotal: {
      type: Number,
      required: true
    }
  },

  data() {
    return {
      completedQuestions: 0,
      totalQuestions: 0,
      isQuitBox : false,
    };
  },

  emits: ['next-question'],
  watch: {
    trueAnswerTotal() {
      this.completeQuestions()
    },
  },

  methods: {
    completeQuestions() {
    this.completedQuestions++;
    },

    quitBoxHandle() {
      this.isQuitBox = !this.isQuitBox
    },

    quitConfirmHandle(){
      router.push('/user-home')
    },
  },
  computed: {
    progressPercent() {
      return (this.completedQuestions / this.totalQuestions) * 100;
    }
  },

  async created() {
    while (this.questionsData === null) {
      await new Promise(resolve => setTimeout(resolve, 100))
    }
    this.totalQuestions = this.questionsData.length - 1;
    this.completedQuestions = 0;
  },
  
  mounted() {
  },


};
</script>

<template>
  <div>
    <div id="container">
      <section>
        <button>
          <div @click="quitBoxHandle" id="quit-button">
            <font-awesome-icon id="close-icon" :icon="['fas', 'x']" />
          </div>
        </button>
        <div>
          <progress :value="progressPercent" max="100">{{ progressPercent }}%</progress>
        </div>
      </section>
    </div>
  </div>
  <div v-if="isQuitBox" id="confirm-quit">
    <div id="quit-box">
      <p>Your progress would not be saved. Are you sure?</p>
      <div>
        <button @click="quitConfirmHandle">CONFIRM</button>
        <button @click="quitBoxHandle">BACK</button>
      </div>
    </div>
  </div>
</template>


<style scoped>
#container {
  max-height: 90px;
  display: flex;
  align-items: center;
}

#container section {
  width: 1000px;
  min-width: 670px;
  margin: 0 auto;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  flex-direction: row;
  height: 120px;
  align-items: center;
}

#container section button {
  background-color: #fff;
  border: none;
}

#container section button #close-icon {
  height: 20px;
  color: #bababa;
}

#container progress {
  width: 900px;
  height: 30px;

}

progress::-webkit-progress-value {
  border-radius: 10px;
}

#quit-button:hover {
  cursor: pointer;
}

/* update css  */
#confirm-quit {
  position: absolute;
  width: 100vw;
  height: 100vh;
  z-index: 2;
  background-color: rgba(53, 53, 53, 0.1);
  backdrop-filter: blur(1px);
  display: flex;
  justify-content: center;
  align-items: center;
}

#confirm-quit #quit-box {
  border-color: #cacaca;
  border-style: solid;
  border-width: 2px 2px 4px 2px;
  width: fit-content;
  height: fit-content;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  border-radius: 20px;
  padding: 20px;
  background-color: #ffffff;
  margin-bottom: 10%;
}

#confirm-quit #quit-box p {
  font-size: 16px;
  font-weight: bolder;
  color: #636363;
}

#confirm-quit #quit-box button {
  width: 110px;
  height: 38px;
  border-radius: 10px;
  border-style: solid;
  border-width: 2px 2px 4px 2px;
  font-size: 16px;
  font-weight: bolder;
  margin: 18px 8px 0px 8px;
  background-color: #fff;
}

#confirm-quit #quit-box button:nth-of-type(1) {
  border-color: #bababa;
  color: #989898;
}

#confirm-quit #quit-box button:nth-of-type(1):hover {
  background-color: #ebebeb;
}

#confirm-quit #quit-box button:nth-of-type(2) {
  background-color: #1cb0f6;
  color: white;
  border-color: #1899d6;
}

#confirm-quit #quit-box button:nth-of-type(2):hover {
  background-color: #30beff;
}

#confirm-quit #quit-box button:hover {
  cursor: pointer;
}

</style>


