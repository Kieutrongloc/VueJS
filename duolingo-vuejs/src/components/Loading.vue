<script>
export default {
    name: 'loading',
    props: {
      loadingMessage: {
      type: String,
      required: true
    }
  },
    data() {
        return {
        }
    },

    created() {
    }
}

</script>

<template>
    <div id="loading">
        <img src="/src/assets/img/addition/duolingo-loading.gif" alt="loading">
        <p>{{ loadingMessage }}</p>
    </div>
</template>

<style>
  #loading {
    display: flex;
    flex-direction: column;
    background-color: #fcfcff;
    width: 100vw;
    min-width: fit-content;
    height: 100vh;
    min-height: fit-content;
    align-items: center;
    justify-content: center;
    padding-bottom: 10%;
  }

  #loading img {
    height: 380px;
    width: 420px;
  }

  #loading p {
    width: fit-content;
    max-width: 80%;
    text-align: center;
    font-size: 16px;
    font-weight: bolder;
    color: #727272;
    margin: 10px 0px;
  }
</style>