<template>
    <div id="MainMiddle">
        <h3 class="font-bold text-2xl py-2 borderY bg-gray-200 w-full text-center">Hauts-De-Seine (92)</h3>

        <div class="w-full grid grid-cols-11 gap-4 mt-2">
            <div class="col-span-4">
                <Category v-for="category in categories.slice(0, 3)"
                          :category="category" :key="category.id">
                </Category>
            </div>
            <div class="col-span-4">
                <Category v-for="category in categories.slice(3, 5)"
                          :category="category" :key="category.id">
                </Category>
            </div>
            <div class="col-span-3">
                <Category v-for="category in categories.slice(5, 7)"
                          :category="category" :key="category.id">
                </Category>
            </div>
        </div>
    </div>
</template>

<script>
    import Category from './Category'


    export default {
        name: "MainMiddle",
        props: [
            'categories'
        ],
        components: {
            Category
        },
    }
</script>

<style scoped>

</style>
