<script>

export default {
  name: 'MissedQuestionsTemplate',
  props: {
    trueInRow: {
      type: Number,
      required : true
    }

  },
  data() {
    return {
      message: "Let's review the exercises you missed!",
    };
  },
  
  async created() {

  },

  methods: {

  }
};
</script>

<template>
  <div id="true-in-row">
    <!-- Template true in row -->
    <div id="message-box">
      <div id="message">
        <p>{{ message }}</p>
      </div>
      <div id="image">
        <img src="/src/assets/img/addition/duolingo-waving.gif" alt="break-img">
      </div>
    </div>
  </div>
</template>


