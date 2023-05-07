<script>
import router from '../../../router';

export default {

  data() {
    return {

    };
  },

  methods: {
    demoHandle() {
      alert('Updating...')
    },

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
                                <input type="password">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>New Password</p>
                            </td>
                            <td>
                                <input type="password">
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </form>
        </section>
    </div>
  </div>
</template>


