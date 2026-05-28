<script setup lang="ts">
import { RouterView } from 'vue-router'
import router from './router';
import { useAuthStore } from './stores/auth';

const authStore = useAuthStore()


</script>

<template>
  <header>
    <h3 style="cursor: pointer;" v-on:click="()=>{router.push('/')}">Transport Management</h3>
    <div style="cursor: pointer;" v-on:click="()=>{if(!authStore.username){router.push('/login')}}" >
      <img>
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg>
        <div class="dropdown" style="margin-left: 30px;" v-if="authStore.username">
            <button class='btn btn-outline-secondary dropdown-toogle' type="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ authStore.username }}
            </button>
            <ul class="dropdown-menu"><li><a class="dropdown-item" v-on:click="authStore.logout">Logout</a></li></ul>
          </div>
        <span style="margin-left: 10px;" v-else>Login</span>
      </img>
    </div>
  </header>
  <body class="body">
    <RouterView />
  </body>

</template>

<style scoped>
header {
  height: 10vh;
  width: 100vw;
  background-color: bisque;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-right: 50px;
  padding-left: 20px;
}
body{
  height: 90vh;
}
/* header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }

  nav {
    text-align: left;
    margin-left: -1rem;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }
} */
</style>
