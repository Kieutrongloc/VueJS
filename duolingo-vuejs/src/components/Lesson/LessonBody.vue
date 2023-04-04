<script>
export default {
  data() {
    return {
      questionDb: JSON.parse(localStorage.getItem('questions')),
      currentQuestion: 1,
      QuestionTemplate: '',
    };
  },
  methods: {

  },
  computed: {

  },
  created() {
    this.QuestionTemplate = this.questionDb[this.currentQuestion].template_name
    this.currentQuestion = 3
  }
};
</script>

<template>
  <div id="container">
    <content>
      <!-- Template image selecting -->
      <div v-if="QuestionTemplate === 'image selecting'" class="question-template" id="template-image-selecting">
        <h1 class="question">{{ questionDb[0].title }}</h1>
        <div class="answer-list">
          <div class="answer-box">
            <div class="image">
              <img src="" alt="answer">
            </div>
            <div class="text">
              <p>answer API</p>
              <span>API</span>
            </div>
          </div>

          <div class="answer-box">
            <div class="image">
              <img src="" alt="answer">
            </div>
            <div class="text">
              <p>answer API</p>
              <span>API</span>
            </div>
          </div>

          <div class="answer-box">
            <div class="image">
              <img src="" alt="answer">
            </div>
            <div class="text">
              <p>answer API</p>
              <span>API</span>
            </div>
          </div>

        </div>
      </div>

      <!-- Template text selecting  -->
      <div v-if="QuestionTemplate === 'text selecting'" class="question-template" id="template-text-selecting">
        <h1 class="question">question API</h1>
        <div class="answer-list">
          <div class="answer-box">
            <div class="text">
              <span>API</span>
              <p>answer API</p>
            </div>
          </div>

          <div class="answer-box">
            <div class="text">
              <span>API</span>
              <p>answer API</p>
            </div>
          </div>

          <div class="answer-box">
            <div class="text">
              <span>API</span>
              <p>answer API</p>
            </div>
          </div>

        </div>
      </div>

      <!-- Template list selecting  -->
      <div v-if="QuestionTemplate === 'list selecting'" class="question-template" id="template-list-selecting">
        <h1 class="question">question API</h1>
        <div class="answer-list">
          <div class="question-detail">
            <div class="question-detail-img">
              <img src="" alt="question img">
            </div>
            <div class="question-detail-des">
              <div>
                <font-awesome-icon class="audio-icon" :icon="['fas', 'volume-high']" />
                <audio controls autoplay>
                  <source src="" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
              </div>
              <p>Description API</p>
            </div>
          </div>
          <div class="user-answer"></div>
          <div class="answer-area">
            <div class="answer-box">
              <div class="text">
                <p>answer API</p>
              </div>
            </div>
  
            <div class="answer-box">
              <div class="text">
                <p>answer API</p>
              </div>
            </div>
  
            <div class="answer-box">
              <div class="text">
                <p>answer API</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Template list selecting  -->
      <div v-if="QuestionTemplate === 'list reordering'" class="question-template" id="template-list-reordering">
        <h1 class="question">question API</h1>
        <div class="answer-list">
          <div class="question-detail">
            <div class="question-detail-img">
              <img src="" alt="question img">
            </div>
            <div class="question-detail-des">
              <div>
                <font-awesome-icon class="audio-icon" :icon="['fas', 'volume-high']" />
                <audio controls autoplay>
                  <source src="" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
              </div>
              <p>Description API</p>
            </div>
          </div>
          <div class="user-answer"></div>
          <div class="answer-area">
            <div class="answer-box">
              <div class="text">
                <p>answer API</p>
              </div>
            </div>
  
            <div class="answer-box">
              <div class="text">
                <p>answer API</p>
              </div>
            </div>
  
            <div class="answer-box">
              <div class="text">
                <p>answer API</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </content>
  </div>
</template>


<style scoped>
#container {
  display: flex;
  align-items: center;
}

#container content {
  width: 1000px;
  min-width: 670px;
  margin: 0 auto;
  padding: 1rem;
  display: flex;
  justify-content: center;
  flex-direction: row;
  height: 100%;
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

audio {
  display: none;
}

.question-template .answer-list {
  display: flex;
}

/* template-image-selecting */
#template-image-selecting .answer-list {
  flex-direction: row;
  justify-content: space-between;
}

#template-image-selecting .answer-list .answer-box {
  border: 2px solid #bababa;
  width: 200px;
  height: 314px;
  border-radius: 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
}

.answer-box:hover {
  cursor: pointer;
  background-color: #f4f4f4;
}

#template-image-selecting .answer-list .answer-box .image {
  height: 160px;
  width: 140px;
  margin: 0px auto;
}

#template-image-selecting .answer-list .answer-box .image img {
  height: 160px;
  width: 140px;
}
#template-image-selecting .answer-list .answer-box .text {
  display: flex;
  justify-content: space-between;
  width: 180px;
  margin: 0px auto;
}

#template-image-selecting .answer-list .answer-box .text p {
  font-size: 18px;
}

.text span {
  color: #8a8a8a;
  font-weight: bolder;
  font-size: 16px;
  border: 2px solid #d2d2d2;
  padding: 2px;
  border-radius: 8px;
}

/* Template text selecting  */
#template-text-selecting .answer-list {
  flex-direction: column;
  margin-bottom: 60px;
}

#template-text-selecting .answer-list .answer-box {
  border: solid 2px #bababa;
  width: 560px;
  margin: 4px auto;
  border-radius: 10px;
}

#template-text-selecting .answer-list .answer-box .text {
  display: flex;
  margin: 12px;
}

#template-text-selecting .answer-list .answer-box .text p {
  width: 100%;
  text-align: center;
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
  border: 1px solid;
}

#template-list-selecting .answer-list .question-detail .question-detail-img img {
  height: 169px;
  width: 114px;
}

#template-list-selecting .answer-list .question-detail .question-detail-des {
  margin-left: 10px;
  display: flex;
  align-items: center;
  border: solid 2px #c8c8c8;
  border-radius: 8px;
  padding: 4px;
}

.audio-icon {
  color: #1cb0f6;
  height: 26px;
  margin: 6px;
}

.audio-icon:hover {
  cursor: pointer;
}

#template-list-selecting .answer-list .user-answer {
  display: flex;
  flex-direction: row;
  border-top: solid 2px #c8c8c8;
  padding: 10px;
  height: 60px;
  border-bottom: solid 2px #c8c8c8;
  margin-bottom: 40px;
  justify-content: center;

}

#template-list-selecting .answer-list .answer-area {
  display: flex;
  flex-direction: row;
  justify-content: center;
  flex-wrap: wrap;
}

#template-list-selecting .answer-list .answer-area .answer-box {
  border: 2px solid #cacaca;
  border-radius: 10px;
  padding: 8px 6px;
  margin: 2px;
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
  border: 1px solid;
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
}

</style>


