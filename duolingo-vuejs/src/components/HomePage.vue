<script>
    import { RouterLink } from 'vue-router';
    export default {
    data() {
  	return {
        isVisible: false,
        currentLanguage: 'ENGLISH',
    	countryList: [
        {id: 1, name: 'SPANISH', svgel: '<svg viewBox="0 66 82 66" data-test="flag-es" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 2, name: 'FRENCH', svgel: '<svg viewBox="0 132 82 66" data-test="flag-fr" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 3, name: 'GERMAN', svgel: '<svg viewBox="0 198 82 66" data-test="flag-de" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 4, name: 'ITALIAN', svgel: '<svg viewBox="0 330 82 66" data-test="flag-it" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 5, name: 'PORTUGESE', svgel: '<svg viewBox="0 594 82 66" data-test="flag-pt" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 6, name: 'DUTCH', svgel: '<svg viewBox="0 726 82 66" data-test="flag-nl-NL" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 7, name: 'JAPANSESE', svgel: '<svg viewBox="0 264 82 66" data-test="flag-ja" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 8, name: 'ARABIC', svgel: '<svg viewBox="0 2178 82 66" data-test="flag-ar" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 9, name: 'CZECH', svgel: '<svg viewBox="0 1848 82 66" data-test="flag-cs" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        {id: 10, name: 'WELSH', svgel: '<svg viewBox="0 1650 82 66" data-test="flag-cy" class="_1v6Jc" style="height: 28.9756px; width: 36px;"><image height="3168" href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg" width="82" xlink:href="https://d35aaqx5ub95lt.cloudfront.net/vendor/87938207afff1598611ba626a8c4827c.svg"></image></svg>'},
        ]
  	}},
    methods: {
        showLanguage() {
            this.isVisible = true;
        },
        hideLanguage() {
            this.isVisible = false;
        },
        selectLanguage(language){
            this.currentLanguage = language;
            this.isVisible = false;
        }
    }
    };
    
</script>

<template>
    <div id="home-page">
        <div id="top-page">
            <header>
                <div id="header">
                    <RouterLink to="/user-home/learn"><p id="title">duolingo</p></RouterLink>
                    <div @mouseover="showLanguage" @mouseleave="hideLanguage">
                        <div @mouseover="showLanguage" id="language">
                            <p>SITE LANGUAGE:</p>
                            <p>{{ currentLanguage }}</p>
                            <font-awesome-icon id="icon-arrow-down" icon="fa-solid fa-chevron-down"/>
                        </div>

                        <div v-if="isVisible" id="language-list">
                            <ul>
                                <li v-for="(item) in countryList" :key="item.id" @click="selectLanguage(item.name)">
                                    <div class="language-icon" v-html="item.svgel"></div>
                                    <span class="language-name">{{ item.name }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
    
            <body>
                <div id="body">
                    <img id="logo-earth" src="src/assets/img/addition/global-img.png" alt="earth-img">
                    <div id="body-content">
                        <p>The free, fun, and effective way to learn a language!</p>
                        <RouterLink to="/sign-up"><button id="to-signup">GET STARTED</button></RouterLink>
                        <RouterLink to="/sign-in"><button id="to-signin">I ALREADY HAVE AN ACCOUNT</button></RouterLink>
                    </div>
                </div>
            </body>
    
            <footer>
                <div id="footer">
                    <font-awesome-icon class="angle-direction" icon="fa-solid fa-angle-left" />
                    <ul id="country-list">
                        <li v-for="(item) in countryList" :key="item.id">
                            <a href="">
                                <div class="country-icon" v-html="item.svgel"></div>
                                <span>{{ item.name }}</span>
                            </a>
                        </li>
                    </ul>
                    <font-awesome-icon class="angle-direction" icon="fa-solid fa-angle-right" />
                </div>
            </footer>
        </div>
    </div>
</template>