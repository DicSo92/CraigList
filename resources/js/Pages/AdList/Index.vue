<template>
    <app-layout>
        <div class="container mx-auto flex justify-center py-4">
            <div class="w-full grid grid-cols-10 gap-4">
                <div class="col-span-2" v-for="annonce in sub_category.annonces">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full" v-if="annonce.images != null" :src="annonce.images[0]" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="font-bold mb-2">{{annonce.title}}</div>
                            <p class="text-gray-700 text-base ellipsis">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum earum nostrum odit porro possimus quibusdam repellat rerum totam, veniam!
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../../Layouts/AppLayout";

    export default {
        name: "AdList",
        props: [
            'sub_category',
        ],
        components: {
            AppLayout,
        },
        data() {
            return {

            }
        },
        computed: {

        },
        methods: {}
    }
</script>

<style scoped>
.ellipsis {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
</style>
