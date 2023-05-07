<script>
import router from '../../../router';

export default {

  data() {
    return {
        formData : {
            currentPw : '',
            newPw : ''
        }
    };
  },

  emits: ['form-data'],

  methods: {
    demoHandle() {
      alert('Updating...')
    },

    updateHandle() {
        console.log(this.formData.currentPw, this.formData.newPw)
        if(this.formData.currentPw !== '' && this.formData.newPw !== '') {
            this.$emit('form-data', this.formData)
        } else {
            this.$emit('form-data', false)
        }
    }
  },

  computed: {

  },

  mounted() {
  }

};
</script>

<template>
  <div id="password_setting">
    <div id="main_content">
        <header>
            <p>Password</p>
        </header>

        <section>
            <form action="">          
                <table>
                    <tbody>
        
                        <tr>
                            <td>
                                <p>Current Password</p>
                            </td>
                            <td>
                                <input type="password" name="current-password" v-model="formData.currentPw" @input="updateHandle">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>New Password</p>
                            </td>
                            <td>
                                <input type="password" name="new-password" v-model="formData.newPw" @input="updateHandle">
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </form>
        </section>
    </div>
  </div>
</template>


