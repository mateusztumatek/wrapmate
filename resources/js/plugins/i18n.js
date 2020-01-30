import Vue from 'vue';
import VueI18n from 'vue-i18n'
Vue.use(VueI18n);
import translations from '../translations';
export const i18n = new VueI18n({
    locale: 'pl',
    fallbackLocale: 'pl',
    messages: translations
})
