<script>
export default {
    name: 'loading',
    data() {
        return {
            messageLoading : 'Please wait while we are fetching your data',
        }
    },

    created() {
        if (localStorage.getItem('lesson')) {this.messageLoading = '15 minutes a day can teach you a language. What can 15 minutes of social media do?'}
    }
}

</script>

<template>
    <div id="loading">
        <img src="./../assets/img/duolingo-loading.gif" alt="loading">
        <p>{{ messageLoading }}</p>
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
    height: 360px;
    width: 400px;
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