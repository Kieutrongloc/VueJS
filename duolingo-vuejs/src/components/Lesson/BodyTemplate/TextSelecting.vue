<script>
export default {
  name: 'TextSelecting',
  data() {
    return {
    };
  },
  

};
</script>

<template>
  <div id="text-selecting">
    <!-- Template text selecting  -->
    <div class="question-template" id="template-text-selecting">
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
</style>