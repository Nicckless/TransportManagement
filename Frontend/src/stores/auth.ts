import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const username = ref(localStorage.getItem('userName'))
  const userrole = ref(localStorage.getItem('userrole'))

  function login(name: string, token: string, role: string) {
    username.value = name
    userrole.value = role

    localStorage.setItem('userName', name)
    localStorage.setItem('token', token)
    localStorage.setItem('userrole', role)
  }

  function logout() {
    username.value = null

    localStorage.removeItem('userName')
    localStorage.removeItem('token')
    localStorage.removeItem('userrole')
  }

  return {
    username,
    userrole,
    login,
    logout,
  }
})
