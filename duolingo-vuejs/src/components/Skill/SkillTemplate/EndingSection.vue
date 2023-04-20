<script>
import { defineAsyncComponent } from 'vue';

export default {
  name: 'EndingSection',
  props: {

  },

  emits: [''],
  watch: {
    
  },

  data() {
    return {
      endingTemplate : ''
    };
  },

  created() {
    this.endingTemplate = 'congratulation'
  },

  methods: {
    
  },

  computed: {
    QuestionComponent() {
      switch (this.endingTemplate) {
        case 'congratulation':
          return defineAsyncComponent(() => import('./EndingSection/Congratulation.vue'));
        case 'xp earning':
          return defineAsyncComponent(() => import('./EndingSection/XpEarning.vue'));
        case 'day streak':
          return defineAsyncComponent(() => import('./EndingSection/DayStreak.vue'));
        default:
          return null;
      }
    },
  },
};
</script>

<template>
  <div id="container">
    <div v-if="disableClick" id="disable-click"></div>
    <section>
      <component :is="QuestionComponent" />
    </section>
  </div>
</template>

<style scoped>

</style>