<template>
    <app-layout>
        <div class="container mx-auto flex flex-col items-center justify-center py-4">
            <div class="mb-4 w-full flex">
                <form @submit.prevent="submit" class="w-full">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-2">
                            <FileSelector :errors="errors"
                                          @changeImages="images = $event" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <Selectors :categories="categories"
                                               :departments="departments"
                                               @changeDepartment="selectedDepartment = $event"
                                               @changeSubCategory="selectedSubCategory = $event"/>
                                </div>

                                <div class="col-span-6">
                                    <jet-label for="title" value="Title"/>
                                    <jet-input id="title" type="text" class="mt-1 block w-full" v-model="title"
                                               autocomplete="title"
                                               placeholder="Title..."/>
                                    <jet-input-error :message="errors.title" class="mt-2"/>
                                </div>
                                <div class="col-span-6">
                                    <jet-label for="description" value="Description"/>
                                    <wysiwyg id="description" type="textarea"
                                             class="form-input rounded-md shadow-sm mt-1 p-0 block w-full"
                                             v-model="description"/>
                                    <jet-input-error :message="errors.description" class="mt-2"/>
                                </div>
                                <div class="col-span-6 flex justify-between items-end">
                                    <div class="">
                                        <jet-label for="price" value="Price"/>
                                        <jet-input id="price" type="text" class="mt-1 block" v-model="price"
                                                   placeholder="12 €/h"
                                                   autocomplete="price"/>
                                        <jet-input-error :message="errors.price" class="mt-2"/>
                                    </div>
                                    <div class="flex items-center justify-end text-right">
                                        <jet-button :class="{ 'opacity-25': loading }" :disabled="loading">
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
    import FileSelector from "./FileSelector"
    import Selectors from "./Selectors"

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
            FileSelector,
            Selectors
        },
        data() {
            return {
                loading: false,

                selectedDepartment: '',
                selectedSubCategory: '',

                title: '',
                description: '',
                images: [],
                price: ''
            }
        },
        watch: {},
        computed: {},
        methods: {
            submit() {
                let data = new FormData()
                data.append('departmentId', this.selectedDepartment)
                data.append('subCategoryId', this.selectedSubCategory)
                data.append('title', this.title)
                data.append('description', this.description || '')
                data.append('price', this.price)
                if (this.images) {
                    this.images.forEach(image => {
                        data.append('images[]', image)
                    })
                }

                this.$inertia.post('/ad/store', data)
                console.log('submitted')
            },
        }
    }
</script>

<style scoped>

</style>

