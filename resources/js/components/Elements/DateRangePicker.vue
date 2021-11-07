<template>
    <div>
        <t-datepicker :range="true" v-model="date" :week-start="1" :months-per-view="2"
                      :close-on-select="false"></t-datepicker>
        <input type="hidden" name="from" :value="date[0]">
        <input type="hidden" name="to" :value="date[1]">
    </div>
</template>

<script>
export default {
    data() {
        return {
            date: []
        }
    }
}
</script>
