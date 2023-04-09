<script>
import { RouterLink } from 'vue-router';
import router from '../../router';
export default {
    name: 'UserLearn',
    data() {
        return {
            onClickStartButton: false,
            unit : JSON.parse(localStorage.getItem('unit')),
            lesson : JSON.parse(localStorage.getItem('lesson')),
            idClicked : ''
        }
    },
    methods: {
        isLearned(status) {
            return status === "learning"
        },
        startButtonHandle(id) {
            this.idClicked = id
            this.onClickStartButton = !this.onClickStartButton
        },
        alertReminder() {
            alert('Please complete your lesson in turn!')
        }
    },
    created() {
        const user = localStorage.getItem("user");
        if (!user) {
        router.push('/')
        }
    },
    mounted() {
    }
}
</script>

<template>
    <div id="container">
      <div>
        <div class="unit" v-for="itemUnit in unit" :key="itemUnit.id">
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
                    <ul class="lesson-list" v-for="itemLesson in lesson" :key="itemLesson.id">
                        <li v-if="itemLesson.unit_id == itemUnit.id">
                            <div v-if="isLearned(itemLesson.status)" @click="startButtonHandle(itemLesson.id)">
                                <p id="button-start">START</p>
                            </div>
                            <button class="lesson-learning-learned" v-if="itemLesson.status === 'learning' || itemLesson.status === 'learned'" @click="startButtonHandle(itemLesson.id)">
                                <font-awesome-icon class="colored-icon" :icon="`${'fa ' + itemLesson.icon}`" />
                            </button>
                            <div id="start-button" v-if="onClickStartButton && idClicked === itemLesson.id">
                                <h2>{{ itemLesson.title }}</h2>
                                <span>Lesson of</span>
                                <RouterLink id="enter-lesson" :to="'../lesson/' + itemUnit.id + '/'+ itemLesson.id"><div><p>START +10 XP</p></div></RouterLink>
                            </div>
                            <button class="lesson-not-learned" v-else-if="itemLesson.status === 'not learned'" @click="alertReminder">
                                <font-awesome-icon  class="gray-icon" icon="fa-solid fa-lock" />
                            </button>
                        </li>
                    </ul>
                </div>
    
                <div class="img">
                    <img src="https://media2.giphy.com/media/wH8aFVGkdmOjxBxR3I/giphy.gif?cid=6c09b952f2510074370281ada164d82082e01063b70749bc&rid=giphy.gif&ct=s" alt="duolingo-bird">
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
  </template>
  
<style scoped>
#container {
    display: flex;
    /* width: 900px; */
    min-width: fit-content;
    /* margin-top: 40px; */
    margin: 40px auto;
}

.unit {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 30px;
}
.unit .unit-box {
    display: flex;
    flex-direction: row;
    background-color: rgb(88,204,2);
    border-radius: 10px;
    padding: 20px 10px;
    justify-content: space-between;
    color: white;
    width: 600px;
    height: 110px;
}

.unit .unit-box h2,
.unit .unit-box p,
.unit .unit-box #icon-book {
  color: white;
  font-weight: bolder;
}

.unit .unit-box span {
    font-size: 18px;
}

.unit .unit-box button {
    border-radius: 12px;
    border: solid 2px #b8b8b8;
    background-color: rgb(88,204,2);
    padding: 10px 20px;
    display: flex;
    align-items: center;
    height: 60px;
}

.unit .unit-box button:hover {
    cursor: pointer;
    background-color: rgb(91, 210, 0);
}

.unit .unit-box #icon-book {
    margin-right: 10px;
    font-size: 26px;
}

.unit .lesson-section {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.unit .lesson {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 40px;
}

.unit .lesson .lesson-list div #button-start {
    color: rgb(88,204,2);
    font-weight: bolder;
    position: absolute;
    z-index: 1;
    background-color: #ffffff;
    padding: 10px 20px;
    border: solid 2px #e9e9e9;
    border-radius: 10px;
    right: 90px;
    top: 16px;
}

.unit .lesson .lesson-list div #button-start:hover {
    cursor: pointer;
}

.unit .lesson ul li {
    list-style: none;
    margin: 10px;
}

.unit .lesson ul li button {
    padding: 24px;
    border-radius: 30px;
    border: none;
    width: 80px;
}

.unit .lesson ul li button:hover {
    cursor: pointer;
}

.unit .lesson ul li #enter-lesson {
    text-decoration: none;
}

.unit .lesson ul li .lesson-learning-learned {
    background-color: rgb(88,204,2);
}

.unit .lesson ul li #start-button {
    position: absolute;
    z-index: 1;
    background-color: rgb(88,204,2);
    border-radius: 10px;
    padding: 10px;
    width: max-content;
    color: white;
    position: absolute;
    right: 90px;
    bottom: -18px;
    /* transition: transform 0.5s ease-in-out; */
}

.unit .lesson ul li #start-button:hover {
    cursor: pointer;
    /* transform: scale(0.8); */
}

.unit .lesson ul li #start-button div {
    background-color: white;
    color: rgb(88,204,2);
    padding: 6px;
    margin-top: 4px;
    border-radius: 10px;
    text-align: center;
}

.unit .lesson ul li #start-button div:hover {
    background-color: #eaeaea;
}

.unit .lesson ul li .lesson-not-learned {
    background-color: rgb(229, 229, 229);
}

.unit .lesson ul li .lesson-learning-learned .colored-icon {
    color: white;
    font-size: 30px;
}

.unit .lesson ul li .lesson-not-learned .gray-icon {
    color: rgb(144, 144, 144);
    font-size: 30px;
}

.unit .img img {
    width: 200px;
    height: 150px;
}

aside {
    margin-left: 30px;
}

#aside {
    width: max-content;
}

#aside #user {
    display: flex;
    justify-content: space-between;
}

#aside #user div {
    display: flex;
    align-items: center;
    padding: 10px;
}

#aside #user div:hover {
    background-color: #dfdfdf;
    border-radius: 10px;
    cursor: pointer;
}

#aside #user img {
    width: 30px;
    margin-right: 10px;
}

#aside #user span {
    font-weight: bolder;
    color: #626262;
} 

#aside #premium #premium-content {
    width: 300px;
}

#aside #premium, #leaderboard, #progress {
    display: flex;
    flex-direction: column;
    border: 2px solid #dfdfdf;
    border-radius: 16px;
    padding: 20px;
    margin-top: 20px;
    width: 400px;
}

#aside #premium #premium-box {
    display: flex;
}

#aside #premium #premium-box #premium-content p {
    font-size: 26px;
    font-weight: bolder;
}

#aside #premium #premium-box #premium-content span {
    color: #626262;
}

#aside #premium button {
    width: 340px;
    align-self: center;
    border: none;
    background-color: rgb(60,77,255);
    font-size: 16px;
    padding: 14px 10px;
    border-radius: 14px;
    color: white;
    margin-top: 26px;
}

#aside #premium button:hover {
    cursor: pointer;
    background-color: rgb(89, 103, 255);
}

#leaderboard p {
    font-size: 26px;
    font-weight: bolder;
    margin-bottom: 20px;
}

#leaderboard div {
    display: flex;
    /* justify-content: space-around; */
    width: 340px;
    align-items: center;
    color: #626262;
}

#leaderboard div img {
    margin: 0px 20px;
}

#progress #progress-xp {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

#progress #progress-xp h3 {
    font-size: 26px;
    font-weight: bolder;
}

#progress #progress-xp p {
    font-weight: bolder;
    color: #1CB0F6;
}

#progress #progress-xp p:hover {
    cursor: pointer;
}

#progress #progress-goal {
    display: flex;
    flex-direction: row;
    align-items: end;
}

#progress #progress-goal #daily-goal {
    margin: 10px;
}

#progress #progress-goal p {
    margin-bottom: 4px;
}

#progress #progress-goal #progress-bar {
    border: #a1a1a1 solid 6px;
    width: 160px;
    border-radius: 10px;
    margin-top: 10px;
}

</style>