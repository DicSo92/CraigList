<template>
    <app-layout>
        <template #header>
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Home
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{category.slug}}
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{annonce.sub_category.slug}}
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{annonce.slug}}
                </h2>
            </div>
        </template>

        <div class="container mx-auto flex-col justify-center py-4">
            <h2 class="text-2xl font-bold border-b mb-3">{{annonce.title}}</h2>
            <div class="w-full grid grid-cols-12 gap-4">
                <div class="col-span-5">
                    <Carousel :images="annonce.images"></Carousel>
                </div>
                <div class="col-span-7">
                    <div class="flex-col mb-3">
                        <div class="flex justify-between items-center mb-2">
                            <div class="rounded bg-purple-200 border border-purple-700 text-purple-700 px-3 py-1">
                                {{annonce.price}}
                            </div>
                            <p class="text-gray-500">23 minutes ago</p>
                        </div>
                        <div class="flex">
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-200 mr-2">
                                {{annonce.department.name}}
                            </span>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-200 mr-2">
                                {{category.title}}
                            </span>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-200">
                                {{annonce.sub_category.title}}
                            </span>
                        </div>
                    </div>

                    <p>{{annonce.description}}</p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import Carousel from './Carousel'

    export default {
        name: 'Annonce',
        props: [
            'category',
            'annonce'
        ],
        components: {
            AppLayout,
            Carousel
        },
        data() {
            return {

            }
        },
        created() {
        },
        computed: {
        },
        methods: {}
    }
</script>

<style>
</style>
