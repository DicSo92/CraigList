<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="container mx-auto flex justify-center py-4">
            <div class="w-full grid grid-cols-12 gap-4">
                <div class="col-span-3 bg-gray-200 p-3 borderX rounded">
                    <MainLeft></MainLeft>
                </div>

                <div class="col-span-7">
                    <MainMiddle :categories="categories" :current="current"></MainMiddle>
                </div>
                <div class="col-span-2 bg-gray-200 p-3 borderX rounded">
                    <MainRight :departments="departments"></MainRight>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import MainLeft from './Left/Main'
    import MainMiddle from './Middle/Main'
    import MainRight from './Right/Main'

    export default {
        name: 'Home',
        props: [
            'departments',
            'categories',
            'current'
        ],
        components: {
            AppLayout,
            MainLeft,
            MainMiddle,
            MainRight
        },
        data() {
            return {}
        },
        created() {
        },
        methods: {}
    }
</script>

<style>
    .borderY {
        border-bottom: 1px solid #d7d7d7;
        border-top: 1px solid #d7d7d7;
    }

    .borderX {
        border-left: 1px solid #d7d7d7;
        border-right: 1px solid #d7d7d7;
    }
</style>
