<style></style>

<template>
    <div class="featured-images">
        <p v-show="postImages.length" class="lead">
            Click on a thumbnail image on the left to select a featured image, or upload a new image on the right.
        </p>
        <p v-show="!postImages.length" class="lead">Upload an image to get started.</p>
        <div class="featured-image-selecter" :class="{'busy': syncing}">
            <div class="current-images">
                <div v-for="postImage in postImages"
                     class="post-image-box"
                     :class="{'featured': postImage.is_feature}"
                     v-on:click="postNewFeaturedImage(postImage)"
                >
                    <img :src="postImage.thumb" alt="">
                </div>
            </div>
            <div class="single-image-uploader-box">
                <single-upload :url="'/admin/api/posts/' + postId + '/images/featured'"
                               default="/images/defaults/default.jpeg"
                               shape="square"
                               size="large"
                               v-on:singleuploadcomplete="addUploadedFeaturedImage"
                               ref="uploader"
                ></single-upload>
            </div>
        </div>
        <div class="loader" v-show="syncing">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ['post-id'],

        data() {
            return {
                syncing: false,
                postImages: []
            }
        },

        computed: {
            featuredImage() {
                let featured = this.postImages.find((image) => image.is_feature);

                return featured ? featured : '';
            }
        },

        mounted() {
            this.syncing = true;
            this.fetchImages();
        },

        methods: {

            fetchImages() {
                this.$http.get('/admin/api/posts/' + this.postId + '/images')
                        .then((res) => this.setFetchedImages(res))
                        .catch(() => console.log('failed'));
            },

            setFetchedImages(res) {
                this.syncing = false;
                this.postImages = res.data;
                this.setNewFeaturedImage(this.featuredImage);
            },

            postNewFeaturedImage(img) {
                this.syncing = true;
                this.$http.patch('/admin/api/posts/' + this.postId + '/images/featured', {image_id: img.id})
                        .then((res) => this.setNewFeaturedImage(img))
                        .catch((err) => console.log(err));
            },

            addUploadedFeaturedImage(img) {
                this.clearPreviousFeaturedImages();
                this.postImages.push(img);
            },

            setNewFeaturedImage(image) {
                this.clearPreviousFeaturedImages();
                this.syncing = false;
                image.is_feature = true;
                this.$refs.uploader.setImage(image.url);
            },

            clearPreviousFeaturedImages() {
                this.postImages.forEach((image) => image.is_feature = false);
            }
        }

    }
</script>