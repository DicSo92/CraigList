<template>
    <app-layout>
        <template #header>
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Home
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{category.title}}
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{sub_category.title}}
                </h2>
            </div>
        </template>

        <div class="container mx-auto flex flex-col items-center justify-center py-4">
            <div class="mb-4 w-full flex justify-end">
                <Pagination :annonces="annonces" @changePage="changePage" />
            </div>
            <h3 class="text-gray-300 text-5xl font-bold" v-if="!annonces.total">
                No Result
            </h3>
            <div class="w-full grid grid-cols-12 gap-4" v-else>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"
                     v-for="annonce in annonces.data"
                     :key="annonce.id">
                    <Card :annonce="annonce"/>
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
        name: "AdList",
        props: [
            'category',
            'sub_category',
            'annonces',
            'current'
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
                this.$inertia.visit(this.route('Annonce.adsBySubCategory',
                    {
                        currentDepartmentSlug: this.current.slug,
                        categorySlug: this.category.slug,
                        subCategorySlug: this.sub_category.slug,
                        page: pageNum,
                        nb: perPage
                    },
                    {
                        preserveState: true
                    }
                ))
            }
        }
    }
</script>

<style scoped>

</style>
