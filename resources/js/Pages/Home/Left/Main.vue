<template>
    <div id="MainLeft" class="flex flex-col items-center">
        <h1 class="text-center text-2xl font-bold text-blue-700 hover:underline cursor-pointer">CraigList</h1>


        <inertia-link v-if="$page.user" :href="route('Annonce.create')" method="get">
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow my-4">
                Publier une annonce
            </button>
        </inertia-link>
        <a v-else :href="route('register')">
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow my-4">
                Publier une annonce
            </button>
        </a>

        <div class="hover:underline cursor-pointer font-bold mb-5">Mon Compte</div>

        <SearchInput></SearchInput>

        <Calendar></Calendar>

        <Links></Links>
    </div>
</template>

<script>
    import SearchInput from "../../../Components/SearchInput";
    import Links from "./Links";
    import Calendar from "./Calendar";

    export default {
        name: "MainLeft",
        components: {
            SearchInput,
            Calendar,
            Links,
        },
        methods: {
        }
    }
</script>

<style scoped>

</style>
