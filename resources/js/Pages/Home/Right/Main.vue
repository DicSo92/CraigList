<template>
    <div>
        <select
            class="block w-full bg-white border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option>Français</option>
            <option>English</option>
        </select>

        <!--                    <div class="w-full my-2 bg-gray-400" style="height: 1px"></div>-->

        <h5 class="font-bold my-2 borderY bg-gray-100 w-full text-center">Départements</h5>
        <div class="flex flex-col items-center overflow-auto h-screen scrollStyle">
            <inertia-link v-for="department in departments"
                          :key="department.id"
                          :href="route('home', {currentDepartmentSlug: department.slug})"
                          @click="changeCurrentDepartment(department)">
                <div class="text-blue-500 text-xs text-center hover:underline cursor-pointer">
                    {{department.name}}
                </div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MainRight",
        props: [
            'departments'
        ],
        methods: {
            changeCurrentDepartment(department) {
                this.$store.commit('departments/changeCurrentDepartment', department)
            }
        }
    }
</script>

<style scoped>
    .scrollStyle::-webkit-scrollbar {
        width: 10px;
    }
    .scrollStyle::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 5px;
    }
    .scrollStyle::-webkit-scrollbar-thumb {
        background: #aaa;
        border-radius: 5px;
    }
    .scrollStyle::-webkit-scrollbar-thumb:hover {
        background: #888;
    }
</style>
