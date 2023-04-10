<script>
export default {
  name: 'ImageSelecting',
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
    console.log(this.currentQuestionData)
  }

};
</script>

<template>
  <div id="image-selecting">
    <!-- Template image selecting -->
    <div class="question-template" id="template-image-selecting">
      <h1 class="question">API</h1>
      <div class="answer-list">

        <div v-for="(question, index) in questionDb" :key="index" class="answer-box">
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

/* template-image-selecting */
#template-image-selecting .answer-list {
  flex-direction: row;
  justify-content: center;
  align-items: center;
}

#template-image-selecting .answer-list .answer-box {
  margin: 0px auto;
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
</style>


