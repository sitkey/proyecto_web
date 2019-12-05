require('./bootstrap');
window.Vue = require('vue');
Vue.component('apipoke', require('./components/Apipoke.vue'));
Vue.component('entrenador', require('./components/entrenador.vue'));
Vue.component('equipokemon', require('./components/equipokemon.vue'));
Vue.component('pokesprite', require('./components/pokesprite.vue'));
const app = new Vue({
    el: '#app'
});
