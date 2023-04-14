<script>
import Micromatch from 'micromatch';

export default {
  name: 'ImageSelecting',
  props: {
    currentQuestionData: {
      type: Object,
      required: true
    },
  },
  data() {
    return {
      mediaRecorder: null,
      chunks: [],
      recording: false,
      sampleAudioUrl: '/src/assets/audio/vietnamese/unit-1/skill-3/toi-muon-choi-bong-da-nhung-thoi-tiet-hom-nay-rat-nong.mp3'
    };
  },
  methods: {
    startRecording() {
      navigator.mediaDevices.getUserMedia({ audio: true })
        .then(stream => {
          this.mediaRecorder = new MediaRecorder(stream);
          this.mediaRecorder.addEventListener('dataavailable', event => {
            this.chunks.push(event.data);
          });
          this.mediaRecorder.start();
          this.recording = true;
        });
    },
    stopRecording() {
      if (this.mediaRecorder) {
        this.mediaRecorder.stop();
        this.recording = false;
      }
    },
    compareAudio() {
      if (this.chunks.length) {
        const recordedAudioBlob = new Blob(this.chunks, { type: 'audio/webm' });
        const recordedAudioUrl = URL.createObjectURL(recordedAudioBlob);

        Micromatch.compare(recordedAudioUrl, this.sampleAudioUrl)
          .then(result => {
            if (result > 0.75) {
              console.log('Audio is similar:', result);
            } else {
              alert('Audio is not similar enough');
            }
          })
          .catch(error => console.error(error));
      } else {
        alert('No recorded audio available');
      }
    }
  }
};
</script>

<template>
  <div>
    <button @click="startRecording">Start Recording</button>
    <button @click="stopRecording">Stop Recording</button>
    <button @click="compareAudio">Compare Audio</button>
  </div>
</template>

<style scoped>

</style>


