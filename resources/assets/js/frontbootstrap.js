window.swal = require('sweetalert');
window.Vue = require('vue');

import axios from 'axios';

axios.interceptors.request.use(function(config){
    config.headers['X-CSRF-TOKEN'] = Laravel.csrfToken
    return config;
});

Vue.prototype.$http = axios;
