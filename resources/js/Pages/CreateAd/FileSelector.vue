<template>
    <div id="FileSelector">
        <input type="file" class="hidden"
               ref="inputFile" multiple
               @change="addImages($event.target.files)">
        <jet-label for="inputFile" value="Images"/>

        <div class="imagesContainer w-full bg-white p-2 border border-gray-300 rounded mt-1 grid grid-cols-4 gap-2">
            <div class="col-span-4 relative" v-show="images.length" v-for="(image, index) in images">
                <img :src="image" alt="Current Photo" class="w-full object-cover" :ref="'image'">
                <div class="absolute bg-gray-200 top-0 right-0 py-1 px-2 rounded-bl cursor-pointer"
                     @click="removeImage(index)">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
                        <path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/>
                    </svg>
                </div>
            </div>
        </div>

        <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="inputFileClick">
            Select Images
        </jet-secondary-button>

        <jet-input-error :message="errors.inputFile" class="mt-2"/>
    </div>
</template>

<script>
    import JetInputError from "../../Jetstream/InputError";
    import JetLabel from "../../Jetstream/Label";
    import JetSecondaryButton from "../../Jetstream/SecondaryButton"

    export default {
        name: "FileSelector",
        props: {
            errors: Object,
        },
        components: {
            JetInputError,
            JetLabel,
            JetSecondaryButton
        },
        data() {
            return {
                images: [],
            }
        },
        watch: {
            images(val) {
                this.$emit('changeImages', val)
            }
        },
        computed: {},
        methods: {
            inputFileClick() {
                this.$refs.inputFile.click();
            },
            addImages(files) {
                if (files.length === 0) return // (emptyArray)

                for (let i=0; i < files.length; i++) {
                    this.images.push(files[i])
                }
                this.renderImages()
            },
            renderImages() {
                this.images.forEach((image, index) => {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.$refs.image[index].src = reader.result;
                    };
                    reader.readAsDataURL(this.images[index]);
                })
            },
            removeImage(imgIndex) {
                this.images.splice(imgIndex, 1)
                this.renderImages()
            }
        }
    }
</script>

<style scoped>
    .imagesContainer {
        min-height: 80px;
    }
</style>
