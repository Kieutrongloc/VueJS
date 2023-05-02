<script>
import { RouterLink } from 'vue-router';
import router from '../../router';
export default {
    name: 'UserLearn',
    data() {
        return {
            isStartButton: false,
            unit : JSON.parse(localStorage.getItem('unit')),
            lesson : JSON.parse(localStorage.getItem('lesson')),
            userCurrentCourse : JSON.parse(localStorage.getItem('user')).current_course_id,
            userCurrentLesson : JSON.parse(localStorage.getItem('user')).current_lesson,
            userCurrentUnit : JSON.parse(localStorage.getItem('user')).current_unit,
            idClicked : ''
        }
    },
    methods: {
        startButtonHandle(id) {
            this.idClicked = id
            this.isStartButton = !this.isStartButton
        },
        alertReminder(id) {
            alert('Please complete your lesson in turn!')
            console.log(id)
        }
    },
    created() {
        const user = localStorage.getItem("user");
        if (!user) {
        router.push('/')
        };
    },
    mounted() {
    }
}
</script>

<template>
    <div id="user-learn">
        <div id="container">
          <div>
            <div class="unit" v-for="(itemUnit, indexUnit) in unit" :key="itemUnit.id">
                <div class="unit-box">
                    <div class="title">
                        <h2> Unit {{ itemUnit.id }}</h2>
                        <span>{{ itemUnit.title }}</span>
                    </div>
                    <button>
                        <font-awesome-icon id="icon-book" icon="fa-solid fa-book" />
                        <p>GUIDEBOOK</p>
                    </button>
                </div>
                <div class="lesson-section">
                    <div class="lesson">
                        <ul class="lesson-list" v-for="(itemLesson, indexLesson) in lesson" :key="itemLesson.id">
                            <li v-if="itemLesson.unit_id == itemUnit.id">
                                <div v-if="((itemLesson.id === userCurrentLesson && itemUnit.id === userCurrentUnit) || (itemLesson.id % 5 == 1 && itemUnit.id > userCurrentUnit)) && isStartButton === false" @click="startButtonHandle(itemLesson.id)">
                                    <p v-if="itemLesson.id === userCurrentLesson && itemUnit.id === userCurrentUnit" class="button-start">START</p>
                                    <p v-else class="button-start">JUMP HERE!</p>
                                </div>
                                <button class="lesson-learning-learned" v-if="(itemLesson.id <= userCurrentLesson && itemUnit.id <= userCurrentUnit) || (itemUnit.id < userCurrentUnit) || (itemLesson.id % 5 == 1 && itemUnit.id > userCurrentUnit)" @click="startButtonHandle(itemLesson.id)">
                                    <font-awesome-icon class="colored-icon" :icon="`${'fa ' + itemLesson.icon}`" />
                                </button>
                                <div id="start-button" v-if="isStartButton && idClicked === itemLesson.id">
                                    <h2>{{ itemLesson.title }}</h2>
                                    <span>Lesson of</span>
                                    <RouterLink id="enter-lesson" :to="'../skill/' + itemUnit.id + '/'+ itemLesson.id"><div><p>START +10 XP</p></div></RouterLink>
                                </div>
                                <button class="lesson-not-learned" v-else-if="(itemLesson.id > userCurrentLesson && itemUnit.id >= userCurrentUnit && itemLesson.id % 5 !== 1)" @click="alertReminder(itemLesson.id)">
                                    <font-awesome-icon  class="gray-icon" icon="fa-solid fa-lock" />
                                </button>
                            </li>
                        </ul>
                    </div>
        
                    <div class="img">
                        <img :src="itemUnit.image" alt="duolingo-bird">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    
        <aside>
            <div id="aside">
                <div id="user">
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/939/939633.png" alt="vietnamese">
                        <span>VIETNAMESE</span>
                    </div>
                    <div id="streak">
                        <img src="https://icons-for-free.com/iconfiles/png/512/colored+gradient+media+social+social+media+tinder+icon-1320192522554159603.png" alt="streak">
                        <span>0</span>
                    </div>
                    <div>
                        <img src="https://cdn-icons-png.flaticon.com/512/1499/1499810.png" alt="lingot">
                        <span>0</span>
                    </div>
                </div>
    
                <div id="premium">
                    <div>
                        <div id="premium-box">
                            <div id="premium-content">
                                <img src="https://d35aaqx5ub95lt.cloudfront.net/images/super/2e50c3e8358914df5285dc8cf45d0b4c.svg" alt="super">
                                <p>Try Super for free</p>
                                <span>No ads, personalized practice, and unlimited Legendary!</span>
                            </div>
                            <img src="https://d35aaqx5ub95lt.cloudfront.net/images/super/fb7130289a205fadd2e196b9cc866555.svg" alt="bird">
                        </div>
                    </div>
                    <button>TRY 2 WEEKS FREE</button>
                </div>
    
                <div id="leaderboard">
                    <p>Unlock Leaderboards!</p>
                    <div>
                        <img src="https://d35aaqx5ub95lt.cloudfront.net/images/leagues/d4280fdf64d66de7390fe84802432a53.svg" alt="unlock">
                        <span>Complete 8 more lessons to start competing</span>
                    </div>
                </div>
    
                <div id="progress">
                    <div id="progress-xp">
                        <h3>XP Progress</h3>
                        <p>EDIT GOAL</p>
                    </div>
                    <div id="progress-goal">
                        <img src="	https://d35aaqx5ub95lt.cloudfront.net/images/4eb7c316f1956d8aff95611c08778667.svg" alt="goal">
                        <div id="daily-goal">
                            <p>Daily Goal</p>
                            <div id="progress-bar"></div>
                        </div>
                        <p>0/10 XP</p>
                    </div>
                    <div></div>
                </div>
            </div>
          </aside>
        </div>
    </div>
</template>