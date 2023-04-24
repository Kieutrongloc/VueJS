<script>
export default {
  name: 'ScoreCard',
  props: {

  },

  data() {
    return {

    };
  },

  watch: {

  },
  
  mounted() {
  },

  methods: {

  }
};
</script>

<template>
  <div id="scorecard">
    <!-- Template score card  -->
    <div id="container">
        <h1>Check out your scorecard!</h1>
        <p>Click the tiles belows to reveal the solutions</p>
        <div id="scorecard-board">

            <div class="scorecard-box">
                <div class="title">
                    <p>question</p>
                    <p>icon</p>
                </div>

                <div class="answer">
                    <p>answer</p>
                    <p>audio</p>
                </div>

                <div class="result">
                    <div class="user-response">
                        <p>YOUR RESPONSE:</p>
                        <span>response</span>
                    </div>

                    <div class="correct-result">
                        <p>CORRECT RESPONSE:</p>
                        <span>response</span>
                    </div>

                </div>

            </div>

        </div>
    </div>
  </div>
</template>

<style scoped>
#scorecard {
    z-index: 1;
    padding: 60px;
    background-color: rgba(53, 53, 53, 0.1);
    backdrop-filter: blur(1px);
    width: 100vw;
    height: 100vh;
}


</style>