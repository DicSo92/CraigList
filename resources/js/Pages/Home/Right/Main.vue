<template>
    <div>
        <select
            class="block w-full bg-white border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option>Français</option>
            <option>English</option>
        </select>

        <!--                    <div class="w-full my-2 bg-gray-400" style="height: 1px"></div>-->

        <h5 class="font-bold my-2 borderY bg-gray-100 w-full text-center">Départements</h5>
        <div class="flex flex-col items-center">
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

</style>
