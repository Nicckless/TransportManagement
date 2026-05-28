<script setup lang="ts">
import axios from 'axios'
import { onMounted, ref } from 'vue'

interface Worker {
  id: number
  name: string
  role: string
  startingDate: string
}

const workers = ref<Worker[]>([])

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

onMounted(() => {
  getAllWorkers()
})
</script>
<template>
  <div class="mainbody">
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
