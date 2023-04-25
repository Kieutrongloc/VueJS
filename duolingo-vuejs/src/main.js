import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'typeface-open-sans'
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* import specific icons */
import { faChevronDown, faAngleLeft, faAngleRight, faXmark, faCircleQuestion, faBook, faStar, faLock, faMoon, faSun, faX, faVolumeHigh, faCircleCheck, faCircleXmark, faMicrophone, faRoadCircleXmark } from '@fortawesome/free-solid-svg-icons'
/* add icons to the library */
library.add(faChevronDown, faAngleLeft, faAngleRight, faXmark, faCircleQuestion, faBook, faStar, faLock, faMoon, faSun, faX, faVolumeHigh, faCircleCheck, faCircleXmark, faMicrophone, faRoadCircleXmark)


import './assets/main.css'

const app = createApp(App)

app.use(router)

app.mount('#app')

app.component('font-awesome-icon', FontAwesomeIcon)
