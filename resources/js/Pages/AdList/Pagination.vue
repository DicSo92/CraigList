<template>
    <div class="pagination flex">
        <paginate
            v-model="current_page"
            :page-count="page_count"
            :margin-pages="0"
            :click-handler="changePage"
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
            <select v-model="selectedOption" class="block ml-1 bg-transparent border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option v-for="option in selectOptions" :value="option">{{option}}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import Paginate from "vuejs-paginate";

    export default {
        name: "Pagination",
        props: [
            'category',
            'subCategory',
            'annonces',
            'current'
        ],
        components: {
            Paginate
        },
        data() {
            return {
                selectedOption: this.annonces.per_page,
                selectOptions: [8, 12, 16, 32, 52],
                current_page: this.annonces.current_page,
                page_count: this.annonces.last_page,
                total_ads: this.annonces.total
            }
        },
        watch: {
            selectedOption (newOption, oldOption) {
                this.changePage(this.current_page)
            }
        },
        methods: {
            changePage(pageNum) {
                console.log(pageNum)

                this.$inertia.visit(this.route('Annonce.adsBySubCategory',
                    {
                        currentDepartmentSlug: this.current.slug,
                        categorySlug: this.category.slug,
                        subCategorySlug: this.subCategory.slug,
                        page: pageNum,
                        nb: this.selectedOption
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
