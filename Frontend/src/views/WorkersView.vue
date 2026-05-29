<script setup lang="ts">
import axios from 'axios'
import { onMounted, ref } from 'vue'
import { Modal } from 'bootstrap'

interface Worker {
  id?: number
  name: string
  password?: string
  role: string
  startingDate?: string
}

const workers = ref<Worker[]>([])
const error = ref<boolean>(false)
const newWorker = ref<Worker>({
  name: '',
  password: '',
  role: '',
})
const responseModal = ref<HTMLElement | null>(null)

const getAllWorkers = () => {
  axios
    .get('http://localhost:8000/api/allWorkers', {
      headers: {
        Accept: 'application/json',
      },
    })
    .then((res) => {
      workers.value = res.data
    })
    .catch((er) => {
      console.log(er)
    })
}

const addWorker = () => {
  console.log({
    name: newWorker.value.name,
    password: newWorker.value.password,
    role: newWorker.value.role,
  })
  axios
    .post(
      'http://localhost:8000/api/createWorker',
      {
        name: newWorker.value.name,
        password: newWorker.value.password,
        role: newWorker.value.role,
      },
      {
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
        },
      },
    )
    .then((res) => {
      console.log(res.data)
      newWorker.value = {
        name: '',
        password: '',
        role: '',
      }
      error.value = false
      if (responseModal.value) {
        Modal.getOrCreateInstance(responseModal.value!).show()
      }
      getAllWorkers()
    })
    .catch((er) => {
      console.log(er)
      error.value = true
      if (responseModal.value) {
        Modal.getOrCreateInstance(responseModal.value!).show()
      }
    })
}

onMounted(() => {
  getAllWorkers()
})
</script>
<template>
  <div class="mainbody">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkerModal">
      Register Worker
    </button>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Role</th>
          <th scope="col">Starting Date</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="worker in workers">
          <th scope="row">{{ worker.id }}</th>
          <td>{{ worker.name }}</td>
          <td>{{ worker.role }}</td>
          <td>{{ worker.startingDate }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="addWorkerModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register Worker</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="addWorker">
            <label style="padding-top: 20px">Workers Name</label>
            <input v-model="newWorker.name" type="text" class="form-control" />
            <label style="padding-top: 20px">Password</label>
            <input
              v-model="newWorker.password"
              type="password"
              class="form-control"
              placeholder="password"
            />
            <label style="padding-top: 20px">Role</label>
            <select class="form-select" required v-model="newWorker.role">
              <option value=""></option>
              <option value="Admin">Admin</option>
              <option value="Manager">Manager</option>
              <option value="Worker">Worker</option>
              <option value="Trucker">Truck Driver</option>
            </select>
            <div style="display: flex; justify-content: end; padding-top: 20px">
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                Register
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="responseModal"
    ref="responseModal"
    :class="!error ? 'modal-success' : 'modal-error'"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div style="display: flex; justify-content: end">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div style="display: flex; justify-content: center">
            <b>{{ !error ? 'Worker was added successfully' : 'An error has occured!' }}</b>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
table {
  width: 50%;
}

.mainbody {
  display: flex;
  justify-content: center;
  margin-top: 100px;
  flex-direction: column;
  align-items: center;
}

.modal-success {
  --bs-modal-bg: rgba(98, 238, 98, 0.815);
  --bs-modal-border-color: green;
}

.modal-error {
  --bs-modal-bg: rgba(238, 98, 98, 0.815);
  --bs-modal-border-color: red;
}
</style>
