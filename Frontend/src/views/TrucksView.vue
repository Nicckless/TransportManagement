<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import axios from 'axios'
import { onMounted, ref } from 'vue'

interface Truck {
  id: number
  licence_plate: string
  kilometrage: number
  driver_id?: number
}

const trucks = ref<Truck[]>([])
const authStore = useAuthStore()
const toDelete = ref<Truck | null>(null)

const modal = ref<HTMLElement | null>(null)

const getAllTrucks = () => {
  axios
    .get('http://localhost:8000/api/allTrucks', {
      headers: {
        Accept: 'application/json',
      },
    })
    .then((res) => {
      console.log(res.data)
      trucks.value = res.data
    })
    .catch((er) => {
      console.log(er)
    })
}

const deleteTruck = (truckId: number) => {
  axios.delete('')
}

onMounted(() => {
  getAllTrucks()
})
</script>
<template>
  <div class="mainbody">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Licence Plate</th>
          <th scope="col">Kilometrage</th>
          <th scope="col">Driver</th>
          <th scope="col" v-if="authStore.userrole == 'admin' || authStore.userrole == 'manager'">
            Delete
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="truck in trucks">
          <td>{{ truck.id }}</td>
          <td>{{ truck.licence_plate }}</td>
          <td>{{ truck.kilometrage }}</td>
          <td>{{ truck.driver_id }}</td>
          <td v-if="authStore.userrole == 'admin' || authStore.userrole == 'manager'">
            <svg
              style="cursor: pointer"
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              fill="red"
              class="bi bi-x-square-fill"
              viewBox="0 0 16 16"
              data-bs-toggle="modal"
              data-bs-target="#confirmModal"
              @click="
                () => {
                  toDelete = truck
                }
              "
            >
              <path
                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"
              />
            </svg>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Truck Deletion</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          Are you sure you want to delete this truck?
          <div>
            <table>
              <tbody>
                <tr>
                  <th>ID</th>
                  <td>{{ toDelete?.id }}</td>
                </tr>
                <tr>
                  <th>Licence Plate</th>
                  <td>{{ toDelete?.licence_plate }}</td>
                </tr>
                <tr>
                  <th>Kilometrage</th>
                  <td>{{ toDelete?.kilometrage }}</td>
                </tr>
                <tr>
                  <th>Driver</th>
                  <td>{{ toDelete?.driver_id }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
            @click="
              () => {
                toDelete = null
              }
            "
          >
            Close
          </button>
          <button type="button" class="btn btn-primary">Delete Truck</button>
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
}
</style>
