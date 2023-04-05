<script>
import { defineAsyncComponent } from 'vue';

export default {
  name: 'LessonBody',
  data() {
    return {
      questionDb: null,
      currentQuestion: 0,
      QuestionTemplate: '',
    };
  },
  methods: {

  },
  computed: {
    QuestionComponent() {
      if (!this.questionDb) return null;

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
    while (JSON.parse(localStorage.getItem('questions')) === null) {
      await new Promise(resolve => setTimeout(resolve,100))
    }
    this.questionDb = JSON.parse(localStorage.getItem('questions')),
    this.QuestionTemplate = this.questionDb[this.currentQuestion].template_name
  },

  mounted() {
    
  }

};
</script>

<template>
  <div id="container">
    <content>
      <component :is="QuestionComponent" />
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


