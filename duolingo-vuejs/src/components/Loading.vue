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