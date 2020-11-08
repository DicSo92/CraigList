<template>
    <div id="MainMiddle">
        <h3 class="font-bold text-2xl py-2 borderY bg-gray-200 w-full text-center">
            {{ current.name }} ({{ current.code }})
        </h3>

        <div class="w-full grid grid-cols-11 gap-4 mt-2">
            <div class="col-span-4">
                <Category v-for="category in categories.slice(0, 3)"
                          :category="category" :key="category.id"
                          :current="current">
                </Category>
            </div>
            <div class="col-span-4">
                <Category v-for="category in categories.slice(3, 5)"
                          :category="category" :key="category.id"
                          :current="current">
                </Category>
            </div>
            <div class="col-span-3">
                <Category v-for="category in categories.slice(5, 7)"
                          :category="category" :key="category.id"
                          :current="current">
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
            'categories',
            'current'
        ],
        components: {
            Category
        },
    }
</script>

<style scoped>

</style>
