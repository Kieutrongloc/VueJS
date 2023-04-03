
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
    <div id="container">
        <div id="top-page">
            <header>
                <div id="header">
                    <RouterLink to="/user-home/learn"><p id="title">Duolingo</p></RouterLink>
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
                    <img id="logo-earth" src="https://png.monster/wp-content/uploads/2022/03/png.monster-1050.png" alt="earth-img">
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

<style scoped>
p {
    font-weight: bolder;
    color: white;
}

#top-page {
    background-color: rgb(35,83,144);
    background-image: url(https://d35aaqx5ub95lt.cloudfront.net/images/4986531ca822d48e57b4a18f40ff5172.svg);
    display: flex;
    flex-direction: column;
    height: 100vh;
    justify-content: space-between;
    min-width: 670px;
}

#header, #body, #footer {
    max-width: 1000px;
    margin: 0 auto;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    flex-direction: row;
}

header #language {
    display: flex;
    width: 240px;
    justify-content: space-between;
}

header #language-list {
    position: absolute;
}

header #language-list ul {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    width: 320px;
    height: 440px;
    z-index: 1;
    background-color: white;
    border-radius: 14px;
    right: 50px;
    margin-top: 10px;
    overflow: auto;
}

header #language-list ul li {
    margin: 20px 20px 0px 12px;
}

header #language-list ul li:hover,
#header #language:hover {
    cursor: pointer;
}

#header img {
    width: 100px;
    filter: opacity(0.1) drop-shadow(0 0 white);
}

#header #title {
    font-size: 40px;
}

#body #logo-earth {
    width: 320px;
    height: 320px;
}

#body #body-content {
    width: 60%;
    display: flex;
    flex-direction: column;
}

#body-content p {
    font-size: 26px;
    text-align: center;
    margin-bottom: 40px;
}

#body-content button {
    margin: 4px auto;
    height: 50px;
    color: white;
    border-radius: 10px;
    font-size: 14px;
    font-weight: bolder;
    width: 320px;
}

#body-content #to-signup {
    background-color: rgb(88,204,2);
    border: none;
}

#body-content #to-signup:hover {
    cursor: pointer;
    background-color: rgb(122, 210, 55);
}

#body-content #to-signin {
    background-color: transparent;
}

#body-content #to-signin:hover {
    cursor: pointer;
    background-color: rgb(34, 78, 136);
}

footer {
    background-color: rgb(10,74,131);
}

#footer .angle-direction {
    color: white;
    margin-top: 6px;
}

#footer ul {
    width: 960px;
    overflow: auto;
    padding: 0 20px;
}

#country-list {
    display: flex;
    flex-direction: row;
}

#country-list .country-icon {
    margin-right: 8px;
}

li {
    list-style: none;
    width: max-content;
    margin-right: 24px;
}

a {
    text-decoration: none;
    color: white;
    display: flex;
    flex-direction: row;
    align-items: center;
    /* width: max-content; */
}

</style>