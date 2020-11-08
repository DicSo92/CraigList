<template>
    <app-layout>
        <div class="container mx-auto flex flex-col items-center justify-center py-4">
            <div class="mb-4 w-full flex">
                <form @submit.prevent="submit" class="w-full">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-2">
                            <input type="file" class="hidden"
                                   ref="photo" multiple
                                   @change="addImages($event.target.files)">
                            <jet-label for="photo" value="Images"/>

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
                                Select A New Photo
                            </jet-secondary-button>

                            <jet-input-error :message="errors.photo" class="mt-2"/>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6">
                                    <div class="grid grid-cols-6 gap-4">
                                        <div class="inline-block relative col-span-2">
                                            <jet-label for="department" value="Department"/>
                                            <div class="relative">
                                                <select class="block appearance-none w-full border border-gray-300 text-gray-700 mt-1 py-2 px-3 pr-8 form-input rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                        id="description" v-model="selectedDepartment">
                                                    <option disabled value="">Choisissez :</option>
                                                    <option v-for="department in departments" :value="department.id">
                                                        ({{department.code}}) {{ department.name }}
                                                    </option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline-block relative col-span-2">
                                            <jet-label for="category" value="Category"/>
                                            <div class="relative">
                                                <select class="block appearance-none w-full border border-gray-300 text-gray-700 mt-1 py-2 px-3 pr-8 form-input rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                        id="category" v-model="selectedCategory">
                                                    <option disabled value="">Choisissez :</option>
                                                    <option v-for="category in categories" :value="category.id">
                                                        {{ category.title }}
                                                    </option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline-block relative col-span-2">
                                            <jet-label for="subCategory" value="Sub-category"/>
                                            <div class="relative">
                                                <select class="block appearance-none w-full border border-gray-300 text-gray-700 mt-1 py-2 px-3 pr-8 form-input rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                        id="subCategory" v-model="selectedSubCategory" :disabled="!selectedCategory">
                                                    <option disabled value="">Choisissez :</option>
                                                    <option v-if="subCategoriesOptions"
                                                            v-for="subCategory in subCategoriesOptions"
                                                            :value="subCategory.id"
                                                            :key="subCategory.id">
                                                        {{ subCategory.title }}
                                                    </option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <jet-label for="title" value="Title"/>
                                    <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title"
                                               autocomplete="title"/>
                                    <jet-input-error :message="errors.title" class="mt-2"/>
                                </div>

                                <div class="col-span-6">
                                    <jet-label for="description" value="Description"/>
                                    <wysiwyg id="description" type="textarea"
                                             class="form-input rounded-md shadow-sm mt-1 p-0 block w-full"
                                             v-model="form.description"/>
                                    <jet-input-error :message="errors.description" class="mt-2"/>
                                </div>

                                <div class="col-span-6">
                                    <div class="flex items-center justify-end px-4 text-right">
                                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Submit
                                        </jet-button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../../Layouts/AppLayout";
    import JetInput from "../../Jetstream/Input";
    import JetInputError from "../../Jetstream/InputError";
    import JetLabel from "../../Jetstream/Label";
    import JetButton from './../../Jetstream/Button'
    import JetSecondaryButton from "../../Jetstream/SecondaryButton"

    export default {
        name: "CreateAd",
        props: {
            errors: Object,
            categories: Array,
            departments: Array
        },
        components: {
            AppLayout,
            JetInput,
            JetInputError,
            JetLabel,
            JetButton,
            JetSecondaryButton
        },
        data() {
            return {
                selectedDepartment: '',
                selectedCategory: '',
                selectedSubCategory: '',

                form: {
                    title: this.title,
                    description: this.description,
                    photo: null,
                },

                images: [],

                photoPreview: null,
            }
        },
        watch: {
            selectedCategory(val) {
                this.selectedSubCategory = ''
            }
        },
        computed: {
            subCategoriesOptions() {
                if (this.selectedCategory) {
                    return this.categories[this.categories.findIndex(category => category.id === this.selectedCategory)].sub_categories
                }
                return null
            }
        },
        methods: {
            submit() {
                let data = new FormData()
                data.append('title', this.form.title || '')
                data.append('description', this.form.description || '')
                if (this.images) {
                    this.images.forEach(image => {
                        data.append('images[]', image)
                    })
                }

                // this.$inertia.post('/ad', data)
                console.log('submitted')
            },

            inputFileClick() {
                this.$refs.photo.click();
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

