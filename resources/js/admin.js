import {i18n} from "./plugins/i18n";

window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
} catch (e) {}



window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.component('elements-component', require('./admin/element-component').default);

const app = new Vue({
    el: '#admin-app',
    i18n,
    data(){
        return{
            base_url: null,
        }
    },
    mounted(){

    }
});
