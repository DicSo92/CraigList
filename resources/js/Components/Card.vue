<template>
    <div class="rounded overflow-hidden shadow-lg h-full flex flex-col w-full">
        <inertia-link :href="route('Annonce.show', {
                            currentDepartmentSlug: annonce.department.slug,
                            categorySlug: annonce.sub_category.category.slug,
                            subCategorySlug: annonce.sub_category.slug,
                            annonceSlug: annonce.slug
                        }, {
                            preserveState: true
                        })">
            <img class="w-full cursor-pointer"
                 :src="annonce.images ? annonce.images[0] : 'https://icon-library.com/images/no-image-available-icon/no-image-available-icon-16.jpg'"
                 alt="Sunset in the mountains">
        </inertia-link>
        <div class="px-5 py-4">
            <div class="flex">
                <span class="float-left mr-1 -mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current text-yellow-400"
                         @click="toggleFavorite"
                         v-if="!favorite">
                        <path d="M12 5.173l2.335 4.817 5.305.732-3.861 3.71.942 5.27-4.721-2.524-4.721 2.525.942-5.27-3.861-3.71 5.305-.733 2.335-4.817zm0-4.586l-3.668 7.568-8.332 1.151 6.064 5.828-1.48 8.279 7.416-3.967 7.416 3.966-1.48-8.279 6.064-5.827-8.332-1.15-3.668-7.569z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current text-yellow-400"
                         @click="toggleFavorite"
                         v-else>
                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                    </svg>
                </span>

                <inertia-link class="font-bold mb-2 cursor-pointer"
                              :href="route('Annonce.show', {
                                  currentDepartmentSlug: annonce.department.slug,
                                  categorySlug: annonce.sub_category.category.slug,
                                  subCategorySlug: annonce.sub_category.slug,
                                  annonceSlug: annonce.slug
                              }, {
                                  preserveState: true
                              })">
                    {{ annonce.title }}
                </inertia-link>

            </div>
            <p class="text-gray-700 text-base ellipsis">
                {{ annonce.description }}
            </p>
        </div>

        <div class="flex-grow flex items-end">
            <div class='flex justify-between items-center text-gray-700 px-5 py-4 w-full'>
                <div class="text-xs">May 6, 2020</div>
                <div class="text-sm text-right">Posted by <span class="text-red-400">{{ annonce.user.name }}</span></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Card",
        props: [
            'annonce',
        ],
        data () {
            return {
                favorite: false,
            }
        },
        methods: {
            toggleFavorite() {
                // axios.get(`/api/annonce/favorite/${this.annonce.id}`)
                //     .then(response => {
                //         console.log(response)
                //     })
                //     .catch(error => {
                //         console.log(error)
                //     })


                let data = new FormData()
                data.append('annonceId', this.annonce.id)

                this.$inertia.post(route('annonce.toggleFavorite'), data)
            }
            // route('annonce.toggleFavorite')


        }
    }
</script>

<style scoped>
    .ellipsis {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .star-svg {
        background-color: #ff0;
    }

    .star-svg path {
        fill: #828282;
    }
</style>
