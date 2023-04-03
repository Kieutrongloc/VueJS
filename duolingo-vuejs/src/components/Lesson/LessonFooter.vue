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
      <button>SKIP</button>
      <button>CHECK</button>
    </content>
  </div>
</template>


<style scoped>
#container {
  max-height: 140px;
  border-top: 2px solid #e5e5e5 ;
}

#container content {
  width: 1000px;
  min-width: 670px;
  margin: auto;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  flex-direction: row;
}

#container content button {
  width: 150px;
  height: 48px;
  background-color: #fff;
  border-radius: 12px;
  border: solid 2px #e5e5e5;
  font-size: 18px;
  color: #a3a3a3;
  font-weight: bolder;
}

#container content button:nth-of-type(1):hover {
  cursor: pointer;
  background-color: #d8d8d8;
}
</style>


