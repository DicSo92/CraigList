<template>
    <app-layout>
        <div class="container mx-auto flex flex-col items-center justify-center py-4">
            <div class="mb-4 w-full flex">
                <form @submit.prevent="submit" class="w-full">

                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-2">

                        </div>

                        <div class="col-span-6 sm:col-span-4 grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <jet-label for="title" value="Title" />
                                <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" autocomplete="title" />
                                <jet-input-error :message="errors.title" class="mt-2" />
                            </div>

                            <div class="col-span-6">
                                <jet-label for="description" value="Description" />
                                <wysiwyg id="description" type="textarea"
                                         class="form-input rounded-md shadow-sm mt-1 p-0 block w-full"
                                         v-model="form.description" />
                                <jet-input-error :message="errors.description" class="mt-2" />
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

    export default {
        name: "CreateAd",
        props: {
            errors: Object,
        },
        components: {
            AppLayout,
            JetInput,
            JetInputError,
            JetLabel,
            JetButton
        },
        data() {
            return {
                form: {
                    title: this.title,
                    description: this.description,
                    photo: null,
                }
            }
        },
        computed: {},
        methods: {
            submit() {
                // this.$inertia.post('/users', this.form)
                console.log('submitted')
            },
        }
    }
</script>

<style scoped>

</style>

