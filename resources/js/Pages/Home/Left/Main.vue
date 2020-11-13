<template>
    <div id="MainLeft" class="flex flex-col items-center">
        <h1 class="text-center text-2xl font-bold text-blue-700 hover:underline cursor-pointer" @click="goPublishPage">CraigList</h1>

        <inertia-link :href="route('Annonce.create')" method="get">
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow my-4">
                Publier une annonce
            </button>
        </inertia-link>

        <div class="hover:underline cursor-pointer font-bold mb-5">Mon Compte</div>

        <Search></Search>

        <Calendar></Calendar>

        <Links></Links>
    </div>
</template>

<script>
    import Search from "./Search";
    import Links from "./Links";
    import Calendar from "./Calendar";

    export default {
        name: "MainLeft",
        components: {
            Search,
            Calendar,
            Links,
        },
        methods: {
            goPublishPage() {
                this.$inertia.visit(this.route('Annonce.create'))
            }
        }
    }
</script>

<style scoped>

</style>
