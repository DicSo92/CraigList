<template>
    <div id="Calendar" class="mt-6 w-full">
        <h3 class="text-center font-bold">Calendrier d'événements</h3>

        <date-picker v-model="date" is-expanded />
    </div>
</template>

<script>
    import Calendar from 'v-calendar/lib/components/calendar.umd'
    import DatePicker from 'v-calendar/lib/components/date-picker.umd'

    export default {
        name: "Calendar",
        components: {
            Calendar,
            DatePicker
        },
        data() {
            return {
                date: new Date(),
            }
        }
    }
</script>

<style scoped>

</style>
