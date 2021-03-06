require('./frontbootstrap');
const lodash = require('lodash');

Vue.component('modal', require('./components/Modal.vue'));
Vue.component('lightbox', require('./components/Lightbox.vue'));
Vue.component('contact-form', require('./components/Contactform.vue'));
Vue.component('dd-lightbox', require('./components/Lightbox.vue'));
Vue.component('signup-widget', require('./components/Signupwidget.vue'));


window.eventHub = new Vue();

const app = new Vue({
    el: '#app',

    created() {
        eventHub.$on('user-alert', this.showAlert)
    },

    methods: {
        showAlert(message) {
            swal({
                type: message.type,
                title: message.title,
                text: message.text,
                showConfirmButton: message.confirm
            });
        }
    }
});

//window.addEventListener('scroll', lodash.throttle(() => {
//    let scrolled = false;
//    if((window.scrollY > 500) && ! document.body.classList.contains('scrolled')) {
//        document.body.classList.add('scrolled');
//    } else if((window.scrollY < 500) && document.body.classList.contains('scrolled')) {
//        console.log('remove');
//        scrolled = false;
//        document.body.classList.remove('scrolled');
//    }
//}, 150));
