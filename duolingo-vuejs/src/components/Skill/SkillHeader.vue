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
    },

    currentQuestion: {
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
      this.currentQuestion < 5 ? this.quitConfirmHandle() : this.isQuitBox = !this.isQuitBox;
    },

    quitConfirmHandle(){
      router.push('/user-home/learn')
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
  <div id="skill-header-container">
    <div id="skill-header">
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
  </div>
</template>
