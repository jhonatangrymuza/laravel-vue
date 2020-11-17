<template>
  <div id="app">
    <div id="crud_imovel">
      <ListImovels msg="Welcome to Your Vue.js App"/>
    </div>
  </div>
</template>

<script>
import ListImovels from '../components/ListImovels.vue'
export default {
  name: 'App',
  components: {
    ListImovels
  }
}
</script>
