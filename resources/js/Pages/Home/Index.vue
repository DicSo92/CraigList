<template>
    <app-layout>
        <div class="container mx-auto flex justify-center py-4">
            <div class="w-full grid grid-cols-12 gap-4">
                <div class="col-span-3 bg-gray-200 text-yyy">tfdgsdfgesrfd</div>
                <div class="col-span-7 bg-blue-500">
                    <h1>{{test}}</h1>
                </div>
                <div class="col-span-2 bg-gray-200 flex flex-col items-center p-3">
                    <select class="block w-full bg-white border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option>Français</option>
                        <option>English</option>
                    </select>

<!--                    <div class="w-full my-2 bg-gray-400" style="height: 1px"></div>-->

                    <h5 class="font-bold my-2 departmentTitle bg-gray-100 w-full text-center">Départements</h5>
                    <div class="flex flex-col items-center">
                        <div v-for="department in departments" class="text-blue-500 text-xs text-center hover:underline cursor-pointer">{{department.name}}</div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'

    export default {
        props: [
            'departments',
            'categories'
        ],
        components: {
            AppLayout
        },
        data() {
            return {
                // departments: this.departments
            }
        },
        computed: {
            test () {
                return this.$store.state.categories.test
            },
        },
    }
</script>

<style scoped>
    .departmentTitle {
        border-bottom: 1px solid gray;
        border-top: 1px solid gray;
    }
</style>
