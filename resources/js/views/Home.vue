<template>
    <div>
        <div v-if="employees[0]">{{ employees }}</div>
        <div v-else>Loading Employees</div>
    </div>
    <div>
        <div>
            <form @submit.prevent="createNewEmployee(data)">
                <label for="name">Navn</label>
                <input type="text" name="name" v-model="data.name" />
                <p v-if="errors.name">{{ errors.name[0] }}</p>
                <label for="name">Email</label>
                <input type="email" name="email" v-model="data.email" />
                <p v-if="errors.email">{{ errors.email[0] }}</p>
                <label for="phone">Telefon</label>
                <input type="numeric" name="phone" v-model="data.phone" />
                <p v-if="errors.phone">{{ errors.phone[0] }}</p>
                <label for="position">Stilling</label>
                <select name="position" v-model="data.position_id">
                    <option value="1" selected>Funktionær</option>
                    <option value="2">Timelønnet</option>
                </select>
                <p v-if="errors.position_id">{{ errors.position_id[0] }}</p>
                <button type="submit">Click</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref } from '@vue/reactivity'


const employees = ref([])
const errors = ref({})

const getAllEmployees = async () => {
    let response = await axios.get('api/employees')
    employees.value = response.data.data
}

getAllEmployees()

const data = ref({
    name: '',
    email: '',
    phone: '',
    position_id: 1
})

const createNewEmployee = async (data) => {
    errors.value = {}
    await axios.post('api/employee', data)
        .then(getAllEmployees())
        .catch((err) => {
            if (err.response.status === 422) {
                errors.value = err.response.data.errors
            }
        })
}


</script>

<style>
</style>
