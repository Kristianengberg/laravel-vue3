<template>
    <div class="container my-3 d-flex flex-column">
        <div class="d-flex justify-content-center">
            <h1 class>Medarbejder Kartotek</h1>
        </div>
        <div class="overflow-auto content-box border rounded bg-secondary text-light shadow mb-3">
            <div class="overflow-auto py-3" v-if="employees[0]">
                <div
                    v-for="employee in employees"
                    :key="employee.email"
                    class="border-bottom row mx-3 my-2 py-2"
                >
                    <span v-for="info in employee" :key="info.email" class="col">{{ info }}</span>
                </div>
            </div>

            <div v-else class="d-flex justify-content-center">
                <img src="../loaders/loadingbar.gif" alt="sk8ter boi" width="64" height="64" class />
            </div>
        </div>

        <div class="p-3 border rounded bg-secondary shadow">
            <form @submit.prevent="createNewEmployee(employee)">
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        name="name"
                        :class="[errors.name ? 'border border-danger' : '', 'form-control']"
                        v-model="employee.name"
                        placeholder="Navn"
                    />
                    <label for="name">Navn</label>
                    <p v-if="errors.name">{{ errors.name[0] }}</p>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="email"
                        name="email"
                        :class="[errors.email ? 'border border-danger' : '', 'form-control']"
                        v-model="employee.email"
                        placeholder="name@example.com"
                    />
                    <label for="email">Email</label>
                    <p v-if="errors.email">{{ errors.email[0] }}</p>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="number"
                        name="phone"
                        :class="[errors.phone ? 'border border-danger' : '', 'form-control']"
                        v-model="employee.phone"
                        placeholder="Telefon"
                    />
                    <label for="phone">Telefon</label>
                    <p v-if="errors.phone">{{ errors.phone[0] }}</p>
                </div>
                <div class="mb-3">
                    <select name="position" v-model="employee.position_id" class="form-select py-3">
                        <option value="1">Funktionær</option>
                        <option value="2">Timelønnet</option>
                    </select>
                    <p v-if="errors.position_id">{{ errors.position_id[0] }}</p>
                </div>
                <div>
                    <button v-if="!creating" type="submit" class="btn btn-primary">Gem</button>
                    <img v-else src="../loaders/fidget.gif" alt="fdiget" height="50" />
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref } from '@vue/reactivity'


const employees = ref([])
const errors = ref([])


const getAllEmployees = async () => {
    let response = await axios.get('api/employees')
    employees.value = response.data.data
}

getAllEmployees()

const employee = ref({
    position_id: 1
})

const creating = ref(false);

const createNewEmployee = async (data) => {
    errors.value = {}
    creating.value = true;
    await axios.post('api/employee', data)
        .then(() => {
            getAllEmployees()
            creating.value = false;
            employee.value = {
                position_id: 1
            }
        })
        .catch((err) => {
            creating.value = false;
            if (err.response.status === 422) {
                errors.value = err.response.data.errors
            }
        })
}


</script>

<style lang="sass">

$element-size: 400px

.content-box
    height: $element-size
</style>
