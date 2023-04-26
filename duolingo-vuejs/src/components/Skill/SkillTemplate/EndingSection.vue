<script>
import { defineAsyncComponent } from 'vue';

export default {
  name: 'EndingSection',
  props: {
    isEndingSection: {
      type: Boolean
    },

    endingSectionTemplate: {
      type: Number
    }
    
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
    this.endingTemplate = 1
  },

  methods: {
    
  },

  computed: {
    QuestionComponent() {
      switch (this.endingTemplate) {
        case 1:
          return defineAsyncComponent(() => import('./EndingSection/Congratulation.vue'));
        // case 'xp earning':
        //   return defineAsyncComponent(() => import('./EndingSection/XpEarning.vue'));
        // case 'day streak':
        //   return defineAsyncComponent(() => import('./EndingSection/DayStreak.vue'));
        default:
          return null;
      }
    },
  },
};
</script>

<template>
  <div id="container">
    <div id="disable-click"></div>
    <section>
      <component :is="QuestionComponent" />
    </section>
  </div>
</template>