/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
require ('./additional');

require ('./functions');
window.Vue = require('vue');
import { MdButton, MdContent, MdField, MdMenu, MdList, MdSpeedDial, MdIcon, MdSteppers, MdCard, MdDivider, MdCheckbox, MdEmptyState} from 'vue-material/dist/components'
import VueLazyload from 'vue-lazyload'
import {i18n} from "./plugins/i18n";

import 'vue-material/dist/vue-material.min.css'
/*
import 'vue-material/dist/theme/default.css'
*/
require('./component');
import Vue2Filters from 'vue2-filters';
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdMenu);
Vue.use(MdList);
Vue.use(MdSpeedDial);
Vue.use(MdIcon);
Vue.use(MdSteppers);
Vue.use(VueLazyload);
Vue.use(MdCard);
Vue.use(MdDivider);
Vue.use(MdCheckbox);
Vue.use(MdEmptyState);
import prototypes from './plugins/uploader';
import mixins from './mixins';
Vue.use(Vue2Filters);
Vue.use(prototypes);
Vue.prototype.$eventBus = new Vue();
Vue.prototype.$uploader.$eventBus = Vue.prototype.$eventBus;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.mixin(mixins);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import {validationMixin} from 'vuelidate';
import {sendMessage} from "./api/contact";
import {
    required,
    email,
} from 'vuelidate/lib/validators'
const app = new Vue({
    mixins:[validationMixin],
    el: '#app',
    i18n,
    data(){
        return{
            expand_faq: null,
            contact:{},
            base_url: null,
            loading: false,
            selectedGallery: null
        }
    },
    validations:{
        contact:{
            email: {required, email},
            topic: {required},
            content: {required}
        }
    },
    mounted(){
      this.$eventBus.$on('startLoading', () => {
          this.loading = true;
      })
        this.$eventBus.$on('stopLoading', () => {
            this.loading = false;
        })
      this.base_url = base_url;
      this.$i18n.locale = server_locale;
    },
    methods:{
        getValidationClass (fieldName) {
            if(this.$v){
                const field = this.$v.contact[fieldName];
                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            }
        },
        sendMessage(){
            this.$v.$touch();
            if(!this.$v.$invalid){
                this.$set(this.contact, 'sending', true);
                sendMessage(this.contact).then(response => {
                    this.$set(this.contact, 'sended', true);
                    this.$eventBus.$emit('addMessage', {text: 'Wysłano wiadomość poprawnie', type: 'success'});
                }).catch(e => {
                    this.$eventBus.$emit('addMessage', {text: 'Nie udało się wysłać wiadomośći', type: 'error'});
                })
            }
        }
    }
});
