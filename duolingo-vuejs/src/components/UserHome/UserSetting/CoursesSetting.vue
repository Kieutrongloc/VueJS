<script>
import router from '../../../router';

export default {

  data() {
    return {
        demoCourses : [
            {id: 1, title: 'Vietnamese', image: 'https://cdn-icons-png.flaticon.com/128/330/330465.png'},
            {id: 2, title: 'Japanese', image: 'https://icons.iconarchive.com/icons/custom-icon-design/flag/256/Japan-Flag-icon.png'},
        ]
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
  <div id="courses_setting">
    <div id="main_content">
        <header>
            <p>Manage Courses</p>
        </header>

        <section>
            <form action="">          
                <table>
                    <tbody>
        
                        <tr>
                            <td>
                                <p>Courses</p>
                            </td>
                            <td>
                                <div class="courses-list" v-for="item in demoCourses" :key="item.id">
                                    <div id="courses">
                                        <img :src="item.image" alt="">
                                        <div>
                                            <p>{{ item.title }}</p>
                                        </div>
                                    </div>
                                    <button @click.prevent="demoHandle">REMOVE</button>
                                </div>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </form>
        </section>
    </div>
  </div>
</template>


