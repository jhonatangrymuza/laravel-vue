<template>
  <div id="app">

    <nav>
      <div class="nav-wrapper blue darken-1">
        <a href="#" class="brand-logo center">Imovel</a>
      </div>
    </nav>
    
    <div class="container">
      <ul>

      <li v-for="(erro,index) of errors" :key="index">
        Erros - <b>{{erro}}</b>
        </li>
      </ul>
      <button @click='exibir_cadastrar_ou_nao()' class="waves-effect waves-light btn-small" >Cadastrar</button>
      <form @submit.prevent="salvar" class="form-cliente" style="display:none">
          <label>E-mail Proprietario</label>
            <input type="email" placeholder="E-mail Proprietario" v-model="imovel.email_proprietario" required>
         
          <label>Rua</label>
            <input type="text" placeholder="Rua"  v-model="imovel.rua" required>

          <label>Bairro</label>
            <input type="text" placeholder="Bairro"  v-model="imovel.bairro" required>
            
          <label>Cidade</label>
            <input type="text" placeholder="Cidade"  v-model="imovel.cidade" required>

          <label>Estado</label>
            <input type="text" placeholder="Estado"  v-model="imovel.estado" required>

          <label>Numero</label>
            <input type="text" placeholder="Numero"  v-model="imovel.numero">

          <label>Complemento</label>
            <input type="text" placeholder="Complemento"  v-model="imovel.complemento">
            
          <label>Status</label>
            <div class="input-field col s12">
              <select v-model="imovel.status" style="display: block !important">
              <option value="" disabled selected>Selecione</option>
              <option value="Contratado">Contratado</option>
              <option value="Não contratado">Não contratado</option>
              </select>
            </div>
            
          <button class="waves-effect waves-light btn-small">Salvar<i class="material-icons left">save</i></button>

      </form>

      <table>

        <thead>

          <tr>
            <th>E-mail proprietario</th>
            <th>Endereço</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>

        </thead>

        <tbody>

          <tr v-for="imovel of imovels" :key=imovel.id>

            <td>{{imovel.email_proprietario}}</td>
            <td>{{imovel.rua}},{{imovel.numero}},{{imovel.cidade}},{{imovel.estado}}</td>
            <td>{{imovel.status}}</td>
            <td>
              <button @click='editar(imovel)' class="waves-effect btn-small blue darken-1"><i class="material-icons">create</i></button>
              <button @click='deletar(imovel)' class="waves-effect btn-small red darken-1"><i class="material-icons">delete_sweep</i></button>
            </td>

          </tr>

        </tbody>
      
      </table>

    </div>

  </div>
</template>

<script>
import Imovels from '../../service/imovels'
export default {

 data(){
 return {
   imovel:{
     id:"",
    email_proprietario:"",
    rua:"",
    bairro:"",
    cidade:"",
    estado:"",
    numero:"",
    complemento:""
   },
   imovels:[],
   errors:[]
   } 
 },

 mounted(){
   this.listar();
 },

 methods:{
   listar(){
    Imovels.listar().then(res=>{
      this.imovels = res.data
     })
   },

   salvar(){
      Swal.fire(
      'Salvando imovel',
       '',
       'info'
      )
     if(!this.imovel.id){
        Imovels.salvar(this.imovel).then(resposta =>{
          this.imovel = {}
          Swal.fire(
          'Cadastrado com sucesso',
          '',
          'success'
          )
          this.listar()
        }).catch(e=>{
          this.errors =e.response.data.errors;
          })
     }else{
        Imovels.atualizar(this.imovel).then(resposta =>{
          this.imovel = {}
          Swal.fire(
            'Atualizado com sucesso',
            '',
            'success'
          )
          this.listar()
        }).catch(e=>{
          this.errors =e.response.data.errors;
          })
     }
     this.errors=[];
     },

     editar(imovel){
       this.imovel = imovel
       jQuery('.form-cliente').show();
     },

     deletar(imovel){
        Swal.fire(
          'Deletando registro',
          '',
          'info'
        )
        Imovels.deletar(imovel.id).then(resposta =>{
            Swal.fire(
              'Deletado com sucesso',
              '',
              'success'
            )
            this.listar()
        })
      },

      exibir_cadastrar_ou_nao(){
        if(jQuery('.form-cliente').is(":visible")){
          jQuery('.form-cliente').hide();
        }else{
          jQuery('.form-cliente').show();
        }

      }
   }  
}
</script>

<style>
</style>
