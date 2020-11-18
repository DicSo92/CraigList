<template>
    <app-layout>
        <template #header>
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Home
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Search
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    "{{search}}"
                </h2>
            </div>
        </template>

        <div class="container mx-auto flex flex-col items-center justify-center py-4">
            <div class="w-full grid grid-cols-10 gap-4">

                <div class="col-span-2">
                    <div class="bg-gray-200 borderX py-3 rounded">
                        <h5 class="font-bold bg-gray-100 w-full mb-2 px-3">Categories : ({{subCategories.length}})</h5>
                        <div class="flex flex-col overflow-auto scrollStyle pl-5 mr-2">
                            <inertia-link v-for="subCategory in subCategories"
                                          :key="subCategory.id"
                                          :href="route('Annonce.adsBySubCategory', {
                                              currentDepartmentSlug: $store.state.departments.current_department.slug,
                                              categorySlug: subCategory.category.slug,
                                              subCategorySlug: subCategory.slug
                                          })">
                                <div class="hover:underline text-sm cursor-pointer">
                                    {{subCategory.title}}
                                </div>
                            </inertia-link>
                            <h6 class="text-sm font-bold text-gray-500" v-if="!subCategories.length">No Results</h6>
                        </div>

                        <h5 class="font-bold bg-gray-100 w-full mt-3 mb-2 px-3">Departments : ({{departments.length}})</h5>
                        <div class="flex flex-col overflow-auto scrollStyle pl-5 mr-2">
                            <inertia-link v-for="department in departments"
                                          :key="department.id"
                                          :href="route('home', {currentDepartmentSlug: department.slug})"
                                          @click="changeCurrentDepartment(department)">
                                <div class="hover:underline text-sm cursor-pointer">
                                    {{department.name}}
                                </div>
                            </inertia-link>
                            <h6 class="text-sm font-bold text-gray-500" v-if="!departments.length">No Results</h6>
                        </div>
                    </div>
                </div>


                <div class="col-span-8">
                    <h2 class="text-2xl text-gray-800 font-bold border-b mb-3">Annonces :</h2>
                    <div class="mb-4 w-full flex justify-end" v-if="annonces.total">
                        <Pagination :annonces="annonces" @changePage="changePage" />
                    </div>
                    <h3 class="text-gray-300 text-5xl text-center font-bold" v-if="!annonces.total">
                        No Results
                    </h3>
                    <div class="w-full grid grid-cols-12 gap-4" v-else>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-4 xl:col-span-3"
                             v-for="annonce in annonces.data"
                             :key="annonce.id">
                            <Card :annonce="annonce"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../../Layouts/AppLayout";
    import Card from "../../Components/Card";
    import Pagination from "../../Components/Pagination";

    export default {
        name: "Search",
        props: [
            'annonces',
            'subCategories',
            'departments',
            'current',
            'search'
        ],
        components: {
            AppLayout,
            Card,
            Pagination
        },
        data() {
            return {

            }
        },
        computed: {},
        methods: {
            changePage({pageNum, perPage}) {
                this.$inertia.visit(this.route('Search.index',
                    {
                        currentDepartmentSlug: this.current.slug,
                        search: this.search,
                        page: pageNum,
                        nb: perPage
                    },
                    {
                        preserveState: true
                    }
                ))
            },
            changeCurrentDepartment(department) {
                this.$store.commit('departments/changeCurrentDepartment', department)
            },
        }
    }
</script>

<style scoped>
    .borderX {
        border-left: 1px solid #d7d7d7;
        border-right: 1px solid #d7d7d7;
    }

    .scrollStyle {
        max-height: 50vh;
    }
    .scrollStyle::-webkit-scrollbar {
        width: 10px;
    }
    .scrollStyle::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 5px;
    }
    .scrollStyle::-webkit-scrollbar-thumb {
        background: #aaa;
        border-radius: 5px;
    }
    .scrollStyle::-webkit-scrollbar-thumb:hover {
        background: #888;
    }
</style>
