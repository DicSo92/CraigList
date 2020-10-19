<template>
    <div class="pagination flex">
        <paginate
            v-model="page"
            :page-count="20"
            :margin-pages="0"
            :click-handler="clickCallback"
            :first-button-text="'<<'" :last-button-text="'>>'"
            :prev-text="'<'" :next-text="'>'"
            first-last-button no-li-surround
            :container-class="'flex'"
            :page-link-class="'border border-1 w-12 h-9 flex items-center justify-center hover:bg-gray-200'"
            :prev-link-class="'border border-1 w-12 h-9 flex items-center justify-center rounded-l ml-2 hover:bg-gray-200'"
            :next-link-class="'border border-1 w-12 h-9 flex items-center justify-center rounded-r mr-2 hover:bg-gray-200'"
            :active-class="'bg-blue-700 hover:bg-blue-700 text-white'" :disabled-class="'bg-gray-200'">
        </paginate>
        <div class="flex items-center ml-6">
            <p>Per page :</p>
            <select
                class="block ml-1 bg-transparent border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option>10</option>
                <option>20</option>
                <option>30</option>
                <option>50</option>
            </select>
        </div>
    </div>
</template>

<script>
    import Paginate from "vuejs-paginate";

    export default {
        name: "Pagination",
        components: {
            Paginate
        },
        data() {
            return {
                page: 1
            }
        },
        methods: {
            clickCallback(pageNum) {
                console.log(pageNum)
            }
        }
    }
</script>

<style scoped>

</style>
