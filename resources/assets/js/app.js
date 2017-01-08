
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('modal', require('./components/Modal.vue'));
Vue.component('editor', require('./components/Editor.vue'));
Vue.component('featured-images', require('./components/Featuredimages.vue'));
Vue.component('single-upload', require('./components/Singleupload.vue'));
Vue.component('publish-button', require('./components/Publishbutton.vue'));
Vue.component('toggle-switch', require('./components/Toggleswitch.vue'));
Vue.component('document-upload', require('./components/Documentupload.vue'));
Vue.component('dropzone', require('./components/Dropzone.vue'));
Vue.component('gallery-show', require('./components/Galleryshow.vue'));

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
