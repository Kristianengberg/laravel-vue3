<template>
    <div>
        <div v-if="employees[0]">{{ employees }}</div>
        <div v-else>Loading Employees</div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref } from '@vue/reactivity'


const employees = ref({})

const getAllEmployees = async () => {
    let response = await axios.get('api/employees')
    employees.value = response.data
}

getAllEmployees()


</script>

<style>
</style>
