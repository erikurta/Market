<script>
import CartPanel from './components/CartPanel.vue'

export default {
  components: { CartPanel }
}
</script>

<template>
  <div id="app">
    <h1>Магазин</h1>
    <router-view />
    <CartPanel />
  </div>
</template>

<style>
#app {
  max-width: 800px;
  margin: 0 auto;
  font-family: sans-serif;
}
</style>