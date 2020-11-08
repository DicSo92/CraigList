<template>
    <div id="Selectors" class="grid grid-cols-6 gap-4">
        <div class="inline-block relative col-span-2">
            <jet-label for="department" value="Department"/>
            <div class="relative">
                <select class="block appearance-none w-full border border-gray-300 text-gray-700 mt-1 py-2 px-3 pr-8 form-input rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="description" v-model="selectedDepartment">
                    <option disabled value="">Choisissez :</option>
                    <option v-for="department in departments" :value="department.id">
                        ({{department.code}}) {{ department.name }}
                    </option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        <div class="inline-block relative col-span-2">
            <jet-label for="category" value="Category"/>
            <div class="relative">
                <select class="block appearance-none w-full border border-gray-300 text-gray-700 mt-1 py-2 px-3 pr-8 form-input rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="category" v-model="selectedCategory">
                    <option disabled value="">Choisissez :</option>
                    <option v-for="category in categories" :value="category.id">
                        {{ category.title }}
                    </option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        <div class="inline-block relative col-span-2">
            <jet-label for="subCategory" value="Sub-category"/>
            <div class="relative">
                <select class="block appearance-none w-full border border-gray-300 text-gray-700 mt-1 py-2 px-3 pr-8 form-input rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="subCategory" v-model="selectedSubCategory" :disabled="!selectedCategory">
                    <option disabled value="">Choisissez :</option>
                    <option v-if="subCategoriesOptions"
                            v-for="subCategory in subCategoriesOptions"
                            :value="subCategory.id"
                            :key="subCategory.id">
                        {{ subCategory.title }}
                    </option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JetLabel from "../../Jetstream/Label";

    export default {
        name: "Selectors",
        props: {
            categories: Array,
            departments: Array
        },
        components: {
            JetLabel,
        },
        data() {
            return {
                selectedDepartment: '',
                selectedCategory: '',
                selectedSubCategory: '',
            }
        },
        watch: {
            selectedCategory(val) {
                this.selectedSubCategory = ''
            }
        },
        computed: {
            subCategoriesOptions() {
                if (this.selectedCategory) {
                    return this.categories[this.categories.findIndex(category => category.id === this.selectedCategory)].sub_categories
                }
                return null
            }
        },
        methods: {

        }

    }
</script>

<style scoped>

</style>
