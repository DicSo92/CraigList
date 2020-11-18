<template>
    <app-layout>
        <template #header>
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Home
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{category.title}}
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{annonce.sub_category.title}}
                </h2>
                <span class="font-bold mx-2">></span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{annonce.title}}
                </h2>
            </div>
        </template>

        <div class="container mx-auto flex-col py-4" id="toPrint">
            <div class="flex-col">
                <h2 class="text-2xl font-bold border-b mb-3">{{annonce.title}}</h2>
                <div class="w-full grid grid-cols-12 gap-4">
                    <div class="col-span-5">
                        <Carousel :images="annonce.images"></Carousel>
                    </div>
                    <div class="col-span-7 flex flex-col">
                        <div class="flex-col mb-3">
                            <div class="flex justify-between items-center mb-2">
                                <div class="rounded bg-purple-200 border border-purple-700 text-purple-700 px-3 py-1">
                                    {{annonce.price}}
                                </div>
                                <p class="text-gray-500">23 minutes ago</p>
                            </div>
                            <div class="flex">
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-200 mr-2">
                                {{annonce.department.name}}
                            </span>
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-200 mr-2">
                                {{category.title}}
                            </span>
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-200">
                                {{annonce.sub_category.title}}
                            </span>
                            </div>
                        </div>
                        <div class="flex-1 flex flex-col justify-between">
                            <p>{{annonce.description}}</p>

                            <div class="flex justify-end" v-if="showBtn">
                                <div class="w-10 h-10 border border-gray-700 rounded flex justify-center items-center bg-gray-200 p-1 hover:bg-gray-300 cursor-pointer"
                                     @click="showQrCode = !showQrCode" :class="showQrCode && 'bg-gray-600 hover:bg-gray-500'">
                                    <svg viewBox="0 -256 1792 1792" class="fill-current" :class="showQrCode ? 'text-gray-200' : 'text-gray-700'">
                                        <g transform="matrix(1,0,0,-1,197.42373,1353.7627)">
                                            <path d="M 384,384 V 256 H 256 v 128 h 128 z m 0,768 V 1024 H 256 v 128 h 128 z m 768,0 v -128 h -128 v 128 h 128 z M 128,129 H 512 V 512 H 128 V 129 z m 0,767 h 384 v 384 H 128 V 896 z m 768,0 h 384 v 384 H 896 V 896 z M 640,640 V 0 H 0 V 640 H 640 z M 1152,128 V 0 h -128 v 128 h 128 z m 256,0 V 0 h -128 v 128 h 128 z m 0,512 V 256 H 1024 V 384 H 896 V 0 H 768 v 640 h 384 V 512 h 128 v 128 h 128 z M 640,1408 V 768 H 0 v 640 h 640 z m 768,0 V 768 H 768 v 640 h 640 z" id="path2993"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="h-10 border border-gray-700 rounded flex justify-center items-center bg-gray-200 p-2 hover:bg-gray-300 ml-2 cursor-pointer"
                                     @click="printAnnonce">
                                    <div class="w-6 mr-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="fill-current text-gray-700">
                                            <path d="M56,18H17V8a2,2,0,0,1,2-2H44a2,2,0,0,1,2,2v6a2,2,0,0,0,4,0V8a6,6,0,0,0-6-6H19a6,6,0,0,0-6,6V18H8a6,6,0,0,0-6,6V42a6,6,0,0,0,6,6h5v7a6,6,0,0,0,6,6H45a6,6,0,0,0,6-6V48h5a6,6,0,0,0,6-6V24A6,6,0,0,0,56,18ZM52,32a4,4,0,1,1,4-4A4,4,0,0,1,52,32ZM47,55a2,2,0,0,1-2,2H19a2,2,0,0,1-2-2V44a2,2,0,0,1,2-2H45a2,2,0,0,1,2,2V55Z"/>
                                        </svg>
                                    </div>
                                    <span class="font-bold text-gray-700">Print</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-col mt-4" v-if="showQrCode">
                <div class="border-b mb-3"></div>
                <div class="flex justify-end">
                    <qrcode-vue :value="value" size="250" level="M" renderAs="svg"></qrcode-vue>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import Carousel from './Carousel'
    import QrcodeVue from 'qrcode.vue'

    export default {
        name: 'Annonce',
        props: [
            'category',
            'annonce'
        ],
        components: {
            AppLayout,
            Carousel,
            QrcodeVue
        },
        data() {
            return {
                value: window.location.href,
                showQrCode: false,
                showBtn: true
            }
        },
        created() {
        },
        computed: {
        },
        methods: {
            printAnnonce () {
                this.showQrCode = true
                this.showBtn = false
                setTimeout(() => { // Prevent print without QrCode
                    this.$htmlToPaper('toPrint', null, () => {
                        this.showQrCode = false
                        this.showBtn = true
                    });
                }, 50)

            }
        }
    }
</script>

<style>
</style>
