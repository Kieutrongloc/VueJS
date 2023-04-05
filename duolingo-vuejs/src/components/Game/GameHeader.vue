<script>

export default {
  name: 'GameHeader',
  components: {
    
  },
  data() {
    return {
    }
  },
  async created() {
    
  },
  methods: {},
  mounted() {
  }
}
</script>

<template>
    <content>
        <button>
          <RouterLink to="/user-home/learn">
            <font-awesome-icon id="close-icon" :icon="['fas', 'x']" />
          </RouterLink>
        </button>
        <div>
          <progress :value="progressPercent" max="100">{{ progressPercent }}%</progress>
        </div>
      </content>
</template>

<style scoped>

#container {
  max-height: 90px;
  display: flex;
  align-items: center;
}

#container content {
  width: 1000px;
  min-width: 670px;
  margin: 0 auto;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  flex-direction: row;
  height: 120px;
  align-items: center;
}

#container content button {
  background-color: #fff;
  border: none;
}

#container content button #close-icon {
  height: 20px;
  color: #bababa;
}

#container progress {
  width: 900px;
  height: 30px;
  /* background-color: #e5e5e5; */

}

progress::-webkit-progress-value {
  /* background-color: #58cc02; */
  border-radius: 10px;
}
</style>
