<style></style>

<template>
    <div class="contact-form-outer">
        <form action="/contact" method="post" @submit.stop.prevent="submitForm" ref="theform">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" v-model="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" v-model="email" required>
            </div>
            <div class="form-group">
                <label class="top-label" for="enquiry">Message</label>
                <textarea name="enquiry" id="enquiry" v-model="enquiry"></textarea>
            </div>
            <button type="submit" class="btn page-section-cta on-dark contact-submit">
                <span v-show="!sending">Send Message</span>
                <div class="spinner" v-show="sending">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </button>
        </form>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        data() {
            return {
                name: '',
                email: '',
                enquiry: '',
                sending: false,
                spent: false
            }
        },

        ready() {
          this.resetForm();
        },

        methods: {

            submitForm() {
                this.sending = true;
                this.$http.post('/contact', this.allData())
                        .then(() => this.onSuccess())
                        .catch(() => this.onFail())
            },

            onSuccess() {
                this.sending = false;
                this.spent = true;
                eventHub.$emit('user-alert', {
                    type: 'success',
                    title: 'Thanks ' + this.name,
                    text: 'Your message has been received, and we will be in touch soon if need be.',
                    confirm: true
                });
                this.resetForm();
            },

            onFail() {
                this.sending = false;
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Oh dear, sorry ' + this.name,
                    text: 'There was a problem getting your message through. Please try again, or contact us using our details on this page.',
                    confirm: true
                });
            },

            allData() {
                let data = JSON.parse(JSON.stringify(this.$data));

                return data;
            },

            resetForm() {
                Vue.nextTick(() => this.$refs.theform.reset());
            }
        }
    }
</script>