<template>
    <app-layout>
        <div class="container mx-auto flex justify-center py-4">
            <div class="w-full grid grid-cols-12 gap-4">
                <div class="col-span-3 bg-gray-200 text-yyy">tfdgsdfgesrfd</div>
                <div class="col-span-7">
                    <h3 class="font-bold text-2xl py-2 borderY bg-gray-200 w-full text-center">Hauts-De-Seine (92)</h3>

                    <div class="w-full grid grid-cols-11 gap-4 mt-2">
                        <div class="col-span-4">
                            <Category v-for="category in categories.slice(0, 3)"
                                      :category="category" :key="category.id">
                            </Category>
                        </div>
                        <div class="col-span-4">
                            <Category v-for="category in categories.slice(3, 5)"
                                      :category="category" :key="category.id">
                            </Category>
                        </div>
                        <div class="col-span-3">
                            <Category v-for="category in categories.slice(5, 7)"
                                      :category="category" :key="category.id">
                            </Category>
                        </div>
                    </div>

                    <h1>{{test}}</h1>
                </div>
                <div class="col-span-2 bg-gray-200 flex flex-col items-center p-3">
                    <select class="block w-full bg-white border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option>Français</option>
                        <option>English</option>
                    </select>

<!--                    <div class="w-full my-2 bg-gray-400" style="height: 1px"></div>-->

                    <h5 class="font-bold my-2 borderY bg-gray-100 w-full text-center">Départements</h5>
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
    import Category from './Category'

    export default {
        props: [
            'departments',
            'categories'
        ],
        components: {
            AppLayout,
            Category
        },
        data() {
            return {

            }
        },
        computed: {
            test () {
                return this.$store.state.categories.test
            },
        },
        methods: {
        }
    }
</script>

<style scoped>
    .borderY {
        border-bottom: 1px solid #acacac;
        border-top: 1px solid #acacac;
    }
</style>
