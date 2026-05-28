<script setup lang="ts">
import router from '@/router'

const props = defineProps<{
  path: string
  msg: string
}>()

const goTo = () => {
  router.push(props.path)
}
</script>

<template>
  <div v-on:click="goTo">
    <h3>{{ msg }}</h3>
  </div>
</template>

<style scoped>
div {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 90%;
  aspect-ratio: 1;
  background-color: rgb(46, 231, 46);
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

div:hover {
  background-color: rgb(152, 239, 152);
}
</style>
