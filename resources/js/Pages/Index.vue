<template>
    <app-layout>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'

    export default {
        components: {
            AppLayout
        },
        created() {
            let department = this.$store.state.departments.current_department
            console.log(department)

            this.$inertia.visit(this.route('home', {departmentSlug: department.slug}, {preserveState: true}))
        },
    }
</script>

<style scoped>

</style>
