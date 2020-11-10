<template>
    <app-layout>
        <div class="container mx-auto flex flex-col items-center justify-center py-4">
            <div class="mb-4 w-full flex justify-end">
                <Pagination :annonces="annonces"
                            :category="category"
                            :subCategory="sub_category"
                            :current="current">
                </Pagination>
            </div>
            <div class="w-full grid grid-cols-12 gap-4">
                <div class="col-span-3"
                     v-for="annonce in annonces.data"
                     :key="annonce.id">
                    <Card :annonce="annonce"
                          :current="current"
                          :subCategory="sub_category"
                          :category="category"></Card>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../../Layouts/AppLayout";
    import Card from "./Card";
    import Pagination from "./Pagination";

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

        }
    }
</script>

<style scoped>

</style>
