<template>
    <app-layout>
        <div class="container mx-auto flex flex-col items-center justify-center py-4">
            <div class="mb-4 w-full flex justify-end">
                <Pagination></Pagination>
            </div>
            <div class="w-full grid grid-cols-10 gap-4">
                <div class="col-span-2" v-for="annonce in sub_category.annonces" :key="annonce.id">
                    <Card :annonce="annonce"></Card>
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
            'sub_category',
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
