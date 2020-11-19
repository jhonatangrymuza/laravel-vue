<template>
  <div id="app">
    <div id="nav">
      <router-link to="/imovel">Cadastrar Imovel</router-link> |
      <router-link to="/ContratoImovel">Contratar Imovel</router-link>
    </div>
    <router-view />
  </div>
</template>

<script>
import ListImovels from './components/ListImovels.vue'
export default {
  name: 'App',
  components: {
    ListImovels
  }
}
</script>
