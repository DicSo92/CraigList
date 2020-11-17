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
            <div class="mb-4 w-full flex justify-end">
                <Pagination :annonces="annonces" @changePage="changePage" />
            </div>
            <div class="w-full grid grid-cols-12 gap-4">
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
        name: "Search",
        props: [
            'annonces',
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
            }
        }
    }
</script>

<style scoped>

</style>
