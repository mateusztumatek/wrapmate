/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
require ('./additional');

require ('./functions');
window.Vue = require('vue');
import { MdButton, MdContent, MdField, MdMenu, MdList, MdSpeedDial, MdIcon } from 'vue-material/dist/components'
import VueLazyload from 'vue-lazyload'
import {i18n} from "./plugins/i18n";

import 'vue-material/dist/vue-material.min.css'
/*
import 'vue-material/dist/theme/default.css'
*/
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdMenu);
Vue.use(MdList);
Vue.use(MdSpeedDial);
Vue.use(MdIcon);

Vue.use(VueLazyload);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('configuration-component', require('./components/configurator-component.vue').default);
Vue.component('colors-component', require('./components/colors-component.vue').default);
Vue.component('info-component', require('./components/info-component').default);
Vue.component('contact-component', require('./components/contact-component').default);
Vue.mixin({
    methods:{
        validURL(str) {
            var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
            return !!pattern.test(str);
        }
    }
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    i18n,
    data(){
        return{
            base_url: null,
        }
    },
    mounted(){
      this.base_url = base_url;
      this.$i18n.locale = server_locale;
    }
});
