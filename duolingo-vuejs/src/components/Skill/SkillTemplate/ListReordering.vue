<script>
export default {
  name: 'ListReordering',
  props: {
    currentQuestionData: {
      type: Object,
      required: true
    },
  },
  data() {
    return {
    };
  },
  
  async created() {
    while ((this.currentQuestionData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }
  },

  mounted() {
    this.replayQuestion()
  },

  methods: {
    replayQuestion() {
      (new Audio(`data:audio/mp3;base64,${this.currentQuestionData.question.q_audio}`)).play();
    }
  }
};
</script>

<template>
  <div id="list-reordering">
    <!-- Template list selecting  -->
    <div class="question-template" id="template-list-reordering">
        <h1 class="question"> {{ currentQuestionData.question.q_title }}</h1>
        <div class="answer-list">
          <div class="question-detail">
            <div class="question-detail-img">
              <img :src="'data:image/jpeg;base64,' + currentQuestionData.question.q_image" alt="question-img" />
            </div>
            <div class="question-detail-des">
              <div>
                <div @click="replayQuestion">
                  <font-awesome-icon class="audio-icon" :icon="['fas', 'volume-high']" />
                </div>
                <audio :src="'data:audio/mp3;base64,' + currentQuestionData.question.q_audio"></audio>
                <!-- <audio controls autoplay>
                  <source src="" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio> -->
              </div>
              <p>{{ currentQuestionData.question.q_description }}</p>
            </div>
          </div>
          <div class="user-answer"></div>

          <div class="answer-area">

            <div class="answer-box" v-for="(answer, index) in currentQuestionData.answers" :key="answer.id">
              <div class="text">
                <p>{{ answer.a_title }}</p>
              </div>
            </div>
  
          </div>
        </div>
    </div>
  </div>
</template>



<style>
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

.audio-icon {
  color: #1cb0f6;
  height: 26px;
  margin: 6px;
}

.audio-icon:hover {
  cursor: pointer;
}

/* Template list reordering  */
#template-list-reordering .answer-list {
  display: flex;
  flex-direction: column;
  margin-bottom: 30px;
}

#template-list-reordering .answer-list .question-detail {
  display: flex;
  flex-direction: row;
  align-items: center;
}

#template-list-reordering .answer-list .question-detail .question-detail-img {
  height: 169px;
  width: 114px;
}

#template-list-reordering .answer-list .question-detail .question-detail-img img {
  height: 169px;
  width: 114px;
}

#template-list-reordering .answer-list .question-detail .question-detail-des {
  margin-left: 10px;
  display: flex;
  align-items: center;
  border: solid 2px #c8c8c8;
  border-radius: 8px;
  padding: 4px;
}

#template-list-reordering .answer-list .user-answer {
  display: flex;
  flex-direction: row;
  border-top: solid 2px #c8c8c8;
  padding: 10px;
  height: 60px;
  border-bottom: solid 2px #c8c8c8;
  margin-bottom: 40px;
  justify-content: center;
}

#template-list-reordering .answer-list .answer-area {
  display: flex;
  flex-direction: row;
  justify-content: center;
  flex-wrap: wrap;
}

#template-list-reordering .answer-list .answer-area .answer-box {
  border: 2px solid #cacaca;
  border-radius: 10px;
  padding: 8px 6px;
  margin: 2px;
  width: 60px;
  display: flex;
  justify-content: center;
}
</style>


