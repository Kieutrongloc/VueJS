<script>
export default {
  name: 'WordFilling',
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
      answerSentence : this.currentQuestionData.answers[0].title,
      missingIndex : null,
      answerId : 0,
    };
  },

  computed: {
    newSentence() {
      return this.answerSentence.split(" ")
    }
  },
  
  async created() {
    while ((this.currentQuestionData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    };
    this.missingIndex = this.newSentence.indexOf("...")
  },

  methods: {
    answerHandle() {
      this.answerId = this.answerId + 1;
      this.$emit('select-answer', this.answerId, this.userAnswer);
    }

  }
};
</script>

<template>
  <div id="list-selecting">
    <!-- Template word filling  -->
    <div class="question-template" id="template-list-selecting">
        <h1 class="question"> {{ currentQuestionData.question.q_title }}</h1>
        <div class="answer-list">
          <div class="question-detail">
            <div class="question-detail-img">
              <img :src="currentQuestionData.question.q_image" alt="question-img" />
            </div>
            <div class="question-detail-des">
              <p>{{ currentQuestionData.question.q_description }}</p>
            </div>
          </div>

          <div class="answer-area">

            <div class="text" v-for="(word, index) in newSentence" :key="index">
              <div>

                <div v-if="index !== missingIndex">
                  <p>{{ word }}</p>
                </div>

                <div v-else>
                  <input v-model="userAnswer" type="text" @input ="answerHandle" placeholder="...................">
                </div>

              </div>
            </div>
  
          </div>
        </div>
    </div>
  </div>
</template>



<style scoped>
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
  border: solid 2px #c8c8c8;
  border-radius: 8px;
  padding: 4px;
  padding: 10px;
}

#template-list-selecting .answer-list .question-detail .question-detail-des p {
  font-size: larger;
  font-weight: 500;
  color: #808080;
}

#template-list-selecting .answer-list .answer-area {
  border: 1px solid#c8c8c8;
  border-radius: 10px;
  height: 200px;
  display: flex;
  flex-direction: row;
  padding: 10px;
  flex-wrap: wrap;
}

#template-list-selecting .answer-list .answer-area .text {
  margin: 4px;
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
}

</style>