<template>
  <div id="container">
    <LessonHeader />
    <LessonBody />
    <LessonFooter />
  </div>
</template>

<script>
import LessonHeader from './LessonHeader.vue'
import LessonBody from './LessonBody.vue'
import LessonFooter from './LessonFooter.vue'

export default {
  name: 'Lesson',
  components: {
    LessonHeader,
    LessonBody,
    LessonFooter
  },
}
</script>

<style scoped>
  #container {
    width: 100vw;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    height: 100vh;
  }
</style>
