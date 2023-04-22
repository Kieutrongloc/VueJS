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
      this.$emit('select-answer', this.answerId, this.userAnswer.join('').toLowerCase().replace(/\s/g,''));
    }
  }
};
</script>

<template>
  <div id="list-selecting">
    <!-- Template word filling  -->
    <div class="question-template" id="template-list-selecting">
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

<style scoped>
#list-selecting {
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

.question-template .answer-list {
  display: flex;
}

/* Template list selecting  */
#template-list-selecting .answer-list {
  display: flex;
  flex-direction: column;
  margin-bottom: 30px;
}

#template-list-selecting .answer-list .question-detail {
  display: flex;
  flex-direction: row;
  align-items: center;
}

#template-list-selecting .answer-list .question-detail .question-detail-img {
  height: 169px;
  width: 114px;
}

#template-list-selecting .answer-list .question-detail .question-detail-img img {
  height: 169px;
  width: 110px;
}

#template-list-selecting .answer-list .question-detail .question-detail-des {
  margin-left: 10px;
  display: flex;
  align-items: center;
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  border-radius: 8px;
  padding: 4px;
  padding: 10px;
}

#template-list-selecting .answer-list .question-detail .question-detail-des p {
  font-size: larger;
  font-weight: 500;
  color: #626262;
}

#answer-box {
  height: 200px;
  border-style: solid;
  border-color: #bababa;
  border-width: 2px 2px 4px 2px;
  border-radius: 10px;
}

#template-list-selecting .answer-list .answer-area {

  display: flex;
  flex-direction: row;
  padding: 10px;
  flex-wrap: wrap;
}

#template-list-selecting .answer-list .answer-area .text {
  margin: 4px;
  height: fit-content;
}

#template-list-selecting .answer-list .answer-area .text p {
  font-size: 18px;
  font-weight: bolder;
  color: #646464;
}

input {
  width: 100px;
  font-size: 18px;
  border: none;
  margin-top: 3.5px;
  outline: none;
  font-weight: bolder;
  color: #646464;
  text-align: center;
  border-bottom: 1px dashed #c0c0c0;
}


</style>