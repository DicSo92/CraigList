<template>
    <div id="Category">
        <h5 class="font-bold text-lg borderY bg-gray-200 w-full text-center mt-3 mb-2">{{ category.title }}</h5>
        <div class="grid grid-cols-12 gap-3">
            <div v-for="part in spliceSubCategories(category).sub_categories"
                 :class="'col-span-' + spliceSubCategories(category).sizeCol" >
                <div class="flex flex-col">
                    <inertia-link v-for="subCategory in part"
                                  :href="route('Annonce.adsBySubCategory', {
                                      currentDepartmentSlug: $store.state.departments.current_department.slug,
                                      categorySlug: category.slug,
                                      subCategorySlug: subCategory.slug})"
                                  :key="subCategory.id">
                        <div class="text-blue-700 font-bold text-xs hover:underline cursor-pointer border-b border-gray-200">{{ subCategory.title }}</div>
                    </inertia-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Category",
        props: [
            'category'
        ],
        methods: {
            spliceSubCategories (category) {
                let splitInto = 2
                let sizeCol = 6

                if (category.id === 3) {
                    splitInto = 3
                    sizeCol = 4
                }
                else if (category.id === 4 || category.id === 6 || category.id === 7) {
                    splitInto = 1
                    sizeCol = 12
                }

                let sizePerArray = category.sub_categories.length / splitInto
                let arrayOfArrays = [];
                for (let i=0; i < category.sub_categories.length; i+=sizePerArray) {
                    arrayOfArrays.push(category.sub_categories.slice(i,i+sizePerArray));
                }

                return {
                    sizeCol: sizeCol,
                    sub_categories: arrayOfArrays
                }
            }
        }
    }
</script>

<style scoped>

</style>
