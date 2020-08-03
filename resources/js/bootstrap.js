import Vue from 'vue';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
import Form from './utilities/Form';
import Errors from './utilities/Errors';
import PortalVue from 'portal-vue';
import 'alpinejs';

Vue.use(PortalVue);
Vue.use(VueSweetalert2);
Vue.use(require('vue-moment'));

window.Vue = require('vue');
window._ = require('lodash');

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Event = new Vue();
window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', { message, level});
};

window.Form = Form;
window.Errors = Errors;
