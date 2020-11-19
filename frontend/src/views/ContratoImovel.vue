<template>
  <div id="app">
    <div id="crud_imovel">
      <ContratoImovel msg="Welcome to Your Vue.js App"/>
    </div>
  </div>
</template>

<script>
import ContratoImovel from '../components/ContratoImovel.vue'
export default {
  name: 'App',
  components: {
    ContratoImovel
  }
}
</script>
