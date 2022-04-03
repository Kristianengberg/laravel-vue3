<template>
    <div>VUE HOME</div>
</template>

<script>
import axios from 'axios'
import { ref } from '@vue/reactivity'

export default {

    setup() {

        const employees = ref({})

        const getAllEmployees = async () => {
            let response = await axios.get('api/employees')
            employees.value = response.data
        }

        getAllEmployees()

        return {

        }
    }

}
</script>

<style>
</style>
