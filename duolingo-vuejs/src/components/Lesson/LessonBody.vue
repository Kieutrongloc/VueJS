<script>
export default {
  data() {
    return {
      // completedLessons: 0,
    };
  },
  methods: {

  },
  computed: {

  }
};
</script>

<template>
  <div id="container">
    <content>
      <div id="template-image-selecting">
        <h1 class="question">question API</h1>
        <div class="answer-list">
          <div class="answer-box">
            <div class="image">
              <img src="" alt="answer">
            </div>
            <div class="text">
              <p>answer API</p>
              <span>order API</span>
            </div>
          </div>

          <div class="answer-box">
            <div class="image">
              <img src="" alt="answer">
            </div>
            <div class="text">
              <p>answer API</p>
              <span>order API</span>
            </div>
          </div>

          <div class="answer-box">
            <div class="image">
              <img src="" alt="answer">
            </div>
            <div class="text">
              <p>answer API</p>
              <span>order API</span>
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

/* 3-template-image-selecting */
#template-image-selecting {
  width: 620px;
  height: 88%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

#template-image-selecting h1 {
  font-size: 36px;
  font-weight: bolder;
}

#template-image-selecting .answer-list {
  display: flex;
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

#template-image-selecting .answer-list .answer-box .text span {
  color: #666;
  font-weight: bolder;
  font-size: 18px;
}

</style>


