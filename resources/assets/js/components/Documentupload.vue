<style>

</style>

<template>
    <div>
        <label for="profile-upload" class="single-upload-label">
            <img :src="imageSrc" alt="" class="profile-image"
                 v-bind:style="{width: prevWidth, height: prevHeight}"
                 v-bind:class="{'processing' : uploading, 'large': size === 'large', 'round': shape === 'round', 'full': size === 'full' }"/>
            <input v-on:change="processFile" type="file" id="profile-upload"/>
        </label>
        <div class="upload-progress-container" v-show="uploading">
        <span class="upload-progress-bar"
              v-bind:style="{width: uploadPercentage + '%'}"></span>
        </div>
        <p class="upload-message"
           v-bind:class="{'error': uploadStatus === 'error', 'success': uploadStatus === 'success'}"
           v-show="uploadMsg !== ''">{{ uploadMsg }}
        </p>
    </div>

</template>

<script type="text/babel">
    import { generatePreview } from './PreviewGenerator.js';
    module.exports = {

        props: {
            default: null,
            url: String,
            shape: {type: String, default: 'square'},
            size: {type: String, default: 'large'},
            previewWidth: {type: Number, default: 300},
            previewHeight: {type: Number, default: 300}
        },

        data() {
            return {
                imageSource: '',
                uploadMsg: '',
                uploading: false,
                uploadStatus: '',
                uploadPercentage: 0,
                accepted_extensions: ['doc', 'docx', 'txt', 'jpeg', 'jpg', 'png', 'bmp', 'pdf'],
                file_type: null,
                default_src: '/images/defaults/default.jpeg',
                stockIcons: {
                    pdf: '/images/defaults/docs/pdf.png',
                    doc: '/images/defaults/docs/word.png',
                    docx: '/images/defaults/docs/word.png',
                    txt: '/images/defaults/docs/doc.png'
                }
            }
        },

        mounted() {
            if (this.default) {
                this.imageSource = this.default;
            }

            const ext = this.imageSource.split('.').pop();
            if (this.accepted_extensions.indexOf(ext) !== -1) {
                this.file_type = ext;
            }
        },

        computed: {
            imageSrc() {
                if (this.imageSource && this.isImage()) {
                    return this.imageSource;
                }

                if(this.imageSource) {
                    this.setStockImageImageFromExt(this.imageSource.split('.').pop());
                    return this.imageSource;
                }

                return this.default_src;
//                return this.imageSource ? this.imageSource : this.default;
            },

            prevWidth() {
                if (this.size === 'preview') {
                    return this.previewWidth + 'px';
                }

                if (this.size === 'large') {
                    return '300px';
                }

                return '200px';
            },

            prevHeight() {
                if (this.size === 'preview') {
                    return 'auto';
                }

                if (this.size === 'large') {
                    return '300px';
                }

                return '200px';
            }
        },

        methods: {

            isImage() {
                if(this.imageSource.indexOf('data:image') !== -1) {
                    return true;
                }

                const image_ext = ['jpeg', 'png', 'jpg'];
                return image_ext.indexOf(this.imageSource.split('.').pop()) !== -1;
            },

            processFile(ev) {
                var file = ev.target.files[0];
                this.clearMessage();
                if (this.isInvalidFileType(file.type)) {
                    console.log(file.type);
                    this.showInvalidFile(file.name);
                    return;
                }
                this.handleFile(file);
            },

            isInvalidFileType(type) {
                const docTypes = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain', 'application/pdf'];
                return !(type.indexOf('image') !== -1 || docTypes.indexOf(type) !== -1);
            },

            showInvalidFile(name) {
                this.uploadMsg = name + ' is not a valid image file';
                this.uploadStatus = 'error';
            },

            handleFile(file) {
                if (file.type.indexOf('image') !== -1) {
                    generatePreview(file, {pWidth: this.previewWidth, pHeight: this.previewHeight})
                            .then((src) => this.imageSource = src)
                            .catch((err) =>console.log(err));
                } else {
                    const ext = file.name.split('.').pop();
                    console.log(ext);
                    this.setStockImageImageFromExt(ext);
                }

                this.uploadFile(file);
            },

            setStockImageImageFromExt(ext) {
                if(this.stockIcons.hasOwnProperty(ext)) {
                    this.imageSource = this.stockIcons[ext];
                } else {
                    this.imageSource = this.default_src;
                }
            },

            uploadFile(file) {
                this.uploading = true;
                this.$http.post(this.url, this.prepareFormData(file), this.getUploadOptions())
                        .then(res => this.onUploadSuccess(res))
                        .catch(err => this.onUploadFailed(err));
            },

            prepareFormData: function (file) {
                let fd = new FormData();
                fd.append('file', file);
                return fd;
            },

            onUploadSuccess(res) {
                this.uploadMsg = "Uploaded successfully";
                this.uploadStatus = 'success'
                this.uploading = false;
                eventHub.$emit('singleuploadcomplete', res.data);
            },

            onUploadFailed(err) {
                this.uploadMsg = 'The upload failed';
                this.uploadStatus = 'error';
                console.log(err);
            },

            getUploadOptions() {
                return {
                    onUploadProgress: (ev) => this.showProgress(parseInt(ev.loaded / ev.total * 100))
                }
            },

            showProgress(progress) {
                this.uploadPercentage = progress;
            },

            clearMessage() {
                this.uploadMsg = ''
            },

            setImage(url) {
                this.imageSource = url;
            }
        }

    }
</script>