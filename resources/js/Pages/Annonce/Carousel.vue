<template>
    <div id="Carousel">
        <div class="imgContainer">
            <img :src="images[selectedImage]" alt="Current Photo" class="w-full object-cover" :ref="'image'">
        </div>
        <div class="grid grid-cols-10 gap-2 mt-2">
            <div class="col-span-2 flex justify-center items-center cursor-pointer"
                 v-for="(image, index) in images"
                 @mouseover="selectedImage = index">
                <div :class="selectedImage === index ? 'border-2 border-orange-400 m-1' : ''">
                    <img :src="image" alt="Current Photo" class="w-full object-cover" :ref="'image'">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Carousel",
        props: [
            'images'
        ],
        data() {
            return {
                selectedImage: 0
            }
        },
    }
</script>

<style scoped>

</style>
