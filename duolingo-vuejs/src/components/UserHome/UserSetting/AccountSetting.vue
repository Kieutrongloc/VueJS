<script>
import { RouterLink } from 'vue-router';
import router from '../../../router';

export default {

  data() {
    return {
      checkboxList : [
        {id: 1, title: 'Facebook Connect', name: 'facebook-connect', status: false},
        {id: 2, title: 'Google Connect', name: 'google-connect', status: false},
        {id: 3, title: 'Sound effects', name: 'sound-effects', status: true},
        {id: 4, title: 'Animations', name: 'animations', status: true},
        {id: 5, title: 'Motivational Messages', name: 'motivational-messages', status: true},
        {id: 6, title: 'Speaking exercises', name: 'speaking-exercises', status: true},
        {id: 7, title: 'Listening exercies', name: 'listening-exercises', status: true},
      ],
      userData : JSON.parse(localStorage.getItem('user')),
      formData : {
        profilePicture: '',
        name: '',
        email: ''
      },
      fileSelected: 'no file selected',
      fixedFormData : {}
    };
  },

  emits: ['form-data'],

  methods: {
    demoHandle() {
      alert('Updating...')
    },

    logoutHandle() {
      localStorage.clear();
      router.push('/')
    },

    onAvatarSelected(event) {
      const file = event.target.files[0];
      const maxSize = 1024 * 1024;
      if (file.size > maxSize) {
          event.target.value = '';
          this.formData.profilePicture = '';
          this.fileSelected = 'the file is too large';
          this.updateHandle()
      } else {
          this.fileSelected = file.name;
          this.formData.profilePicture = file
          this.updateHandle()
      }
    },

    updateHandle() {
      const finalFormData = {};
      if (JSON.stringify(this.fixedFormData) !== JSON.stringify(this.formData)) {
        for (const key in this.formData) {
          if (this.fixedFormData.hasOwnProperty(key)) {
            if(this.fixedFormData[key] !== this.formData[key]) {
              finalFormData[key] = this.formData[key]
              this.$emit('form-data', finalFormData)
            }
          }
        }
      } else {
        this.$emit('form-data', false)
      }
    },

  },

  watch: {
    formData: {
      deep: true,
      handler(newVal) {
        this.updateHandle()
      }
    }
  },

  computed: {
  },

  created() {
    this.formData.profilePicture = this.userData.avatar
    this.formData.name = this.userData.user_name;
    this.formData.email = this.userData.userid;
    this.fixedFormData = {...this.formData}
  },

  mounted() {

  }

};
</script>

<template>
  <div id="account-setting">
    <div id="main_content">
      <header>
        <p>Account</p>
      </header>

      <section>
        <form action="">          
          <table>
            <tbody>
  
              <tr id="picture_upload">
                <td>
                  <p>Profile Picture</p>
                </td>
                <td>
                  <label for="upload-avatar" class="custom-file-upload">
                    Upload Avatar
                  </label>
                  <input id="upload-avatar" type="file" name="upload-avatar" accept="image/png, image/jpeg" @change="onAvatarSelected">
                  <span>{{ fileSelected }}</span>
                  <span>maximum image size is 1 MB</span>
                </td>
              </tr>
  
              <tr id="name">
                <td>
                  <p>Name</p>
                </td>
                <td>
                  <input type="text" v-model="formData.name" name="user-name">
                </td>
              </tr>
  
              <tr id="email">
                <td>
                  <p>Email</p>
                </td>
                <td>
                  <input type="text" v-model="formData.email" name="user-email">
                  <small @click="demoHandle">Email not verified. Verified now</small>
                </td>
              </tr>
  
              <tr class="check-box-item" v-for="item in checkboxList" :key="item.id">
                <td>
                  <p>{{ item.title }}</p>
                </td>
                <td>
                  <input class="check-box" type="checkbox" :id="item.id" :name="item.name" :checked="item.status" v-model="item.status">
                  <label :for="item.id">
                    <div id="toggle" :class="[!item.status ? 'off-status' : '']">
                      <div v-if="!item.status" id="toggle-off"></div>
                      <div v-else id="toggle-on"></div>
                    </div>
                  </label>
                </td>
              </tr>
  
              <tr id="log_out">
                <td>
                  <p></p>
                </td>
                <td @click="logoutHandle">
                  <span>LOGOUT</span>
                </td>
              </tr>
  
              <tr id="export_data">
                <td>
                  <p></p>
                </td>
                <td @click="demoHandle">
                  <span>EXPORT MY DATA</span>
                </td>
              </tr>
  
              <tr id="delete_account">
                <td>
                  <p></p>
                </td>
                <td @click="demoHandle">
                  <span>DELETE MY ACCOUNT</span>
                </td>
              </tr>
  
            </tbody>
          </table>
        </form>
      </section>
    </div>
  </div>
</template>


