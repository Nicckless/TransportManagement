<script setup lang="ts">
import router from '@/router'
import { useAuthStore } from '@/stores/auth'
import axios from 'axios'
import { ref } from 'vue'

const name = ref('')
const password = ref('')
const authStore = useAuthStore()

const login = () => {
  axios
    .post(
      'http://localhost:8000/api/login',
      {
        name: name.value,
        password: password.value,
      },
      {
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
        },
      },
    )
    .then((res) => {
      console.log(res)
      authStore.login(res.data.user.name, res.data.token, res.data.user.role)
      router.push('/')
    })
    .catch((er) => {
      console.log(er)
    })
}
</script>
<template>
  <div class="body">
    <div style="width: 25rem" class="card">
      <div class="card-header"><h4>Login</h4></div>
      <div class="card-body">
        <form @submit.prevent="login">
          <label for="">Name:</label>
          <input v-model="name" type="text" class="form-control" placeholder="Username" />
          <label for="">Password:</label>
          <input v-model="password" type="password" class="form-control" placeholder="password" />
          <div style="display: flex; justify-content: end">
            <button type="submit" class="btn btn-success">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style scoped>
.body {
  display: flex;
  width: 100%;
  height: 100%;
  justify-content: center;
  align-items: center;
}

label {
  margin-top: 20px;
}

button {
  margin-top: 20px;
}
</style>
