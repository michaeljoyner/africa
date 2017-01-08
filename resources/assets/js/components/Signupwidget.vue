<style></style>

<template>
    <div class="expedition-signup-widget">
        <button class="btn block-btn join-btn" v-on:click="openWidget">
            <span v-show="!syncing">Join Now</span>
            <div class="spinner" v-show="syncing">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </button>
        <modal :show="showModal">
            <div slot="header">
                <h3>Join Us On {{ expeditionName }}</h3>
            </div>
            <div slot="body">
                <form ref="signupform" id="expedition-signup-form" action="" @submit.stop.prevent="submitForm">

                    <p class="body-text">Let us know your contact details, and if you have anything to ask or
                        say, and we will get back to you ASAP. Thanks.</p>
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <span class="error-msg" v-show="errorMessages.name">{{ errorMessages.name }}</span>
                        <input :class="{'has-error': errorMessages.name}" @keypress="clearError('name')" type="text" v-model="formData.name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email: </label>
                        <span class="error-msg" v-show="errorMessages.email">{{ errorMessages.email }}</span>
                        <input :class="{'has-error': errorMessages.email}" @keypress="clearError('email')" type="email" v-model="formData.email" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Phone number: </label>
                        <span class="error-msg" v-show="errorMessages.phone">{{ errorMessages.phone }}</span>
                        <input :class="{'has-error': errorMessages.phone}" @keypress="clearError('phone')" type="text" v-model="formData.phone" placeholder="Optional">
                    </div>
                    <div class="form-group">
                        <label for="name">Enquiry: </label>
                        <span class="error-msg" v-show="errorMessages.enquiry">{{ errorMessages.enquiry }}</span>
                    <textarea v-model="formData.enquiry"
                              :class="{'has-error': errorMessages.enquiry}"
                              @keypress="clearError('enquiry')"
                              placeholder="If you have anything to say or ask, here is the place to do it."></textarea>
                    </div>
                    <div class="modal-btn-group">
                        <button class="modal-cancel-btn btn-grey" type="button"
                                @click.prevent.stop="showModal = false">
                            Cancel
                        </button>
                        <button class="btn modal-action-btn" type="submit" form="expedition-signup-form">
                            Join
                        </button>
                    </div>

                </form>
            </div>
            <div slot="footer">

            </div>
        </modal>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['expedition-slug', 'expedition-name'],

        data() {
            return {
                showModal: false,
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    enquiry: ''
                },
                syncing: false,
                errorMessages: {
                    name: '',
                    email: '',
                    phone: '',
                    enquiry: ''
                }
            };
        },

        methods: {

            openWidget() {
                this.showModal = true;
            },

            submitForm() {
                if (this.isIncomplete()) {
                    return;
                }
                this.syncing = true;
                this.clearErrors();
                this.$http.post(`/expeditions/${this.expeditionSlug}/sign-up`, this.formData)
                        .then(res => this.onSuccess(res))
                        .catch(err => this.onFail(err));
                this.showModal = false;
            },

            isIncomplete() {
                return this.formData.name === '' || this.formData.email === '';
            },

            onSuccess(res) {
                this.syncing = false;
                eventHub.$emit('user-alert', {
                    type: 'success',
                    title: `Thank You ${this.formData.name}`,
                    text: 'We have received your info and will get back to you soon.'
                });
                this.resetForm();
            },

            onFail(err) {
                this.syncing = false;
                if(err.response.status === 422) {
                    return this.handleInvalidResponse(err.response.data);
                }
                this.alertOfError();
            },

            alertOfError() {
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: `Sorry ${this.formData.name}, there was a problem`,
                    text: 'We were unable to process your request. Please refresh the page and try again. If the problem persists, kindly contact us. Thanks.'
                });
            },

            handleInvalidResponse(errors) {
                Object.keys(errors).forEach(field => this.errorMessages[field] = errors[field][0]);
                this.showModal = true;
            },

            resetForm() {
                this.formData.name = '';
                this.formData.email = '';
                this.formData.phone = '';
                this.formData.enquiry = '';
            },

            clearErrors() {
                this.errorMessages.name = '';
                this.errorMessages.email = '';
                this.errorMessages.phone = '';
                this.errorMessages.enquiry = '';
            },

            clearError(field) {
                this.errorMessages[field] = '';
            }
        }
    }
</script>