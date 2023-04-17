<script>

export default {
  name: 'BreakTemplate',
  props: {
    trueInRow: {
      type: Number,
      required : true
    }

  },
  data() {
    return {
      breakMessage : null,
    };
  },
  
  async created() {
    this.breakMessage = this.trueInRow

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
        <p> CONGRATULATIONS. You got {{ breakMessage }} correct answers in a row. Keep it up!</p>
      </div>
      <div id="image">
        <img src="/src/assets/img/addition/duolingo-jump.gif" alt="break-img">
      </div>
    </div>
  </div>
</template>

<style scoped>
#true-in-row {
  display: flex;
  align-items: flex-end;
  width: 100%;
}

#true-in-row #message-box {
  display: flex;
  flex-direction: column;
  margin-left: 20%;
}

#message {
  border: solid #d7d7d7 2px;
  border-radius: 20px;
  padding: 20px;
  width: 200px;
  height: max-content;
  top: 50px;  
}

#message p {
  width: fit-content;
  height: fit-content;
  text-align: center;
  display: block;
  font-weight: bolder;
  color: #545454;
}

#true-in-row #message-box #image {
  display: flex;
  flex-direction: row;
}

#true-in-row #message-box img {
  height: 200px;
  width: fit-content;
}

</style>


