<script>
import { defineAsyncComponent } from 'vue';

export default {
  name: 'LessonBody',
  props: {
    questionsData: {
      type: Array,
      required: true
    },
    currentQuestion: {
      type: Number,
      required: true
    }
  },

  emits: ['next-question'],
  watch: {
    currentQuestion(newValue) {
      this.$emit('next-question', newValue);
      this.QuestionTemplate = this.questionsData[this.currentQuestion].template_name
      // console.log(this.QuestionTemplate)
    },
  },

  data() {
    return {
      QuestionTemplate: '',
      isLoading: true,
    };
  },
  methods: {

  },
  computed: {
    QuestionComponent() {
      switch (this.QuestionTemplate) {
        case 'image selecting':
          return defineAsyncComponent(() => import('./BodyTemplate/ImageSelecting.vue'));
        case 'text selecting':
          return defineAsyncComponent(() => import('./BodyTemplate/TextSelecting.vue'));
        case 'list selecting':
          return defineAsyncComponent(() => import('./BodyTemplate/ListSelecting.vue'));
        case 'list reordering':
          return defineAsyncComponent(() => import('./BodyTemplate/ListReordering.vue'));
        default:
          return null;
      }
    },
  },

  async created() {
    while ((this.questionsData) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }
    this.QuestionTemplate = this.questionsData[this.currentQuestion].template_name
  },

  async mounted() {

  }

};
</script>

<template>
  <div id="container">
    <content>
      <component :is="QuestionComponent" />
      <!-- <p>{{ currentQuestion }}</p> -->
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
</style>


