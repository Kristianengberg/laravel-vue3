<template>
    <div>VUE HOME</div>
</template>

<script>
import axios from 'axios'
import { ref } from '@vue/reactivity'

export default {

    setup() {

        const value = ref({})

        const test = async () => {
            let response = await axios.get('api/employees')
            value.value = response.data
        }

        test()

        return {

        }
    }

}
</script>

<style>
</style>
