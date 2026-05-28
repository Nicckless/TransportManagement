<script setup lang="ts">
import RouteIcon from '@/components/RouteIcon.vue'
</script>

<template>
  <main>
    <nav class="row row-cols-4 g-3 mt-5 justify-content-start">
      <div class="col">
        <RouteIcon path="/" msg="Home"></RouteIcon>
      </div>

      <div class="col">
        <RouteIcon path="/about" msg="About"></RouteIcon>
      </div>
      <div class="col">
        <RouteIcon path="/trucks" msg="Trucks"></RouteIcon>
      </div>
      <div class="col">
        <RouteIcon path="/workers" msg="Workers"></RouteIcon>
      </div>
    </nav>
  </main>
</template>

<style>
main {
  display: flex;
  justify-content: center;
}
nav {
  height: auto;
  width: 70%;
  padding: 20px;
}

.col {
  display: flex;
  justify-content: center;
  align-items: center;
  aspect-ratio: 1;
}
</style>
