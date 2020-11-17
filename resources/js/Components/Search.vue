<template>
    <div class="relative text-gray-600 w-full flex items-center">
        <input class="w-full pl-5 pr-8 text-sm z-40 form-input rounded-md shadow-sm"
                   type="search" name="search" placeholder="Search..."
                   v-model="search"
                   @keyup.enter="getSearch" />

        <div class="absolute right-3 z-50" v-if="loading">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="h-5 w-5 fill-current">
                <circle cx="50" cy="50" fill="none" stroke="#4b5563" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                    <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                </circle>
            </svg>
        </div>
        <button @click="getSearch" class="absolute right-4 z-50" v-else>
            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 56.966 56.966">
                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
            </svg>
        </button>

        <div class="dropdown absolute rounded top-0 pt-10 pb-2 w-full bg-white border z-20" v-if="dropdown && search">
            <h3 class="mt-2 px-3 bg-gray-200"
                v-if="!searchDepartments.total && !searchCategories.total && !searchAnnonces.total">
                No result
            </h3>

            <h3 v-if="searchAnnonces && searchAnnonces.total"
                class="mt-2 px-3 bg-gray-200">
                Annonces ({{searchAnnonces.total}}) :
            </h3>
            <p class="ml-5" v-for="annonce in searchAnnonces.data">{{annonce.title}}</p>

            <h3 v-if="searchCategories && searchCategories.total"
                class="mt-2 px-3 bg-gray-200">
                Categories ({{searchCategories.total}}) :
            </h3>
            <p class="ml-5" v-for="category in searchCategories.data">{{category.title}}</p>

            <h3 v-if="searchDepartments && searchDepartments.total"
                class="mt-2 px-3 bg-gray-200">
                Departments ({{searchDepartments.total}}) :
            </h3>
            <p class="ml-5" v-for="department in searchDepartments.data">{{department.name}}</p>
        </div>
    </div>
</template>

<script>

    export default {
        name: "Search",
        data() {
            return {
                search: '',
                loading: false,
                dropdown: false,

                searchDepartments: null,
                searchCategories: null,
                searchAnnonces: null
            }
        },
        components: {
        },
        created() {
            this.debouncedGetSearch = this._.debounce(this.getSearch, 600)
        },
        watch: {
            search: function (val) {
                this.debouncedGetSearch()
            }
        },
        computed: {},
        methods: {
            getSearch() {
                if (!this.search.length) return

                this.loading = true

                axios.get(`/api/search/${this.search}`)
                    .then(response => {
                        console.log(response)
                        this.searchDepartments = response.data.departments
                        this.searchCategories = response.data.categories
                        this.searchAnnonces = response.data.annonces

                        this.loading = false
                        this.dropdown = true
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }
    }
</script>

<style scoped>

</style>
