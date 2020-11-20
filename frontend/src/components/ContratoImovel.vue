<template>
  <div id="app">

    <nav>
      <div class="nav-wrapper blue darken-1">
        <a href="#" class="brand-logo center">Cadastrar contrato de imovel</a>
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

          <label>Imoveis disponivel</label>
        <label>Imoveis</label>
            <div class="input-field col s12">
              <select required v-model="contrato.id_imovel" style="display: block !important">
              <option value="" selected>Selecione</option>
              <option v-for="imovel in imovels" :key="imovel" :value="imovel.id">{{ imovel.rua }}, Nº:{{ imovel.numero }}, {{ imovel.complemento }}, {{ imovel.bairro }}</option>
              </select>
            </div>

         <label>Tipo de Pessoa</label>
            <div class="input-field col s12">
              <select id="tipodepessoa" required v-model="contrato.tipo_pessoa" style="display: block !important">
              <option value="" selected>Selecione</option>
              <option value="fisica">Fisica</option>
              <option value="juridica">Juridica</option>
              </select>
            </div>

          <label>Documento</label>
            <vue-mask class='tp-fisica' type="text" id="documento" placeholder="CPF" mask="###.###.###-##" maxlength="14" v-model="contrato.documento" required></vue-mask>
            <vue-mask class='tp-juridica' type="text" id="documento" placeholder="CNPJ"  mask="##.###.###/####-##" maxlength="18" v-model="contrato.documento" required></vue-mask>
            
          <label>E-mail Contratante</label>
            <input type="email" placeholder="E-mail contratante"  v-model="contrato.email_contratante" required>

          <label>Nome Completo</label>
            <input type="text" placeholder="Nome Completo" required v-model="contrato.nome_completo">

            
          <button class="waves-effect waves-light btn-small">Salvar<i class="material-icons left">save</i></button>

      </form>

      <table>

        <thead>

          <tr>
            <th>Imovel contratado</th>
            <th>Tipo de pessoa</th>
            <th>Documento</th>
            <th>E-mail contratante</th>
            <th>Nome Completo</th>
          </tr>

        </thead>

        <tbody>

          <tr v-for="contrato of contratos" :key=contrato.id_contrato>

            <td>{{ contrato.rua }}, Nº:{{ contrato.numero }}, {{ contrato.complemento }}, {{ contrato.bairro }}</td>
            <td>{{contrato.tipo_pessoa}}</td>
            <td>{{contrato.documento}}</td>
            <td>{{contrato.email_contratante}}</td>
            <td>{{contrato.nome_completo}}</td>
            <td>
              <button @click='editar(contrato)' class="waves-effect btn-small blue darken-1"><i class="material-icons">create</i></button>
              <button @click='deletar(contrato.id_contrato)' class="waves-effect btn-small red darken-1"><i class="material-icons">delete_sweep</i></button>
            </td>

          </tr>

        </tbody>
      
      </table>

    </div>

  </div>
</template>

<script>
import ContratoImovel from '../../service/contratoImovel'
import Imovels from '../../service/imovels'
import vueMask from 'vue-jquery-mask';
export default {

 data(){
 return {
   contrato:{
    id:"",
    id_imovel:"",
    tipo_pessoa:"",
    documento:"",
    email_contratante:"",
    nome_completo:"",
   },
   contratos:[],
   imovels:[],
   errors:[]
   } 
 },
     components: {
      vueMask
    },

 mounted(){
   this.listar();
 },

 methods:{
   listar(){
    ContratoImovel.listar().then(res=>{
      this.contratos = res.data
     });
      Imovels.listar().then(res=>{
      this.imovels = res.data
     });
     
   },

   salvar(){
      Swal.fire(
      'Salvando contrato',
       '',
       'info'
      )
     if(!this.contrato.id){
        ContratoImovel.salvar(this.contrato).then(resposta =>{
          this.contrato = {}
          Swal.fire(
          'Cadastrado com sucesso',
          '',
          'success'
          )
          this.listar()
        }).catch(e=>{
          console.log(e.response)
            Swal.fire(
          'Error',
          e.response.data.message,
          'error'
          )
          this.errors =e.response.data;
          })
     }else{
        ContratoImovel.atualizar(this.contrato).then(resposta =>{
          this.contrato = {}
          Swal.fire(
            'Atualizado com sucesso',
            '',
            'success'
          )
          this.listar()
        }).catch(e=>{
          Swal.fire(
          'Error',
          e.response.data.message,
          'error'
          )
          this.errors =e.response.data.errors;
          })
     }
     this.errors=[];
     },

     editar(contrato){
       this.contrato = contrato
       jQuery('.form-cliente').show();
       if(contrato.tipo_pessoa === 'fisica'){
         setTimeout(function(){ 
           jQuery('.tp-fisica').show();
           jQuery('.tp-juridica').hide();

         }, 100);
        }else if(contrato.tipo_pessoa === 'juridica'){
          setTimeout(function(){ 
            jQuery('.tp-fisica').hide();
            jQuery('.tp-juridica').show();
          }, 100);
        }
     },

     deletar(contrato){
        Swal.fire(
          'Deletando registro',
          '',
          'info'
        )
        ContratoImovel.deletar(contrato).then(resposta =>{
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

$(document).ready(function(){
  $("#documento").blur(function(){
    if(!validaCpfCnpj(this.value)){
      Swal.fire(
        'Error',
        'Numero de documento invalido',
        'error'
      )
    }
  });
});
   
function validaCpfCnpj(val) {
    if (val.length == 14) {
        var cpf = val.trim();
     
        cpf = cpf.replace(/\./g, '');
        cpf = cpf.replace('-', '');
        cpf = cpf.split('');
        
        var v1 = 0;
        var v2 = 0;
        var aux = false;
        
        for (var i = 1; cpf.length > i; i++) {
            if (cpf[i - 1] != cpf[i]) {
                aux = true;   
            }
        } 
        
        if (aux == false) {
            return false; 
        } 
        
        for (var i = 0, p = 10; (cpf.length - 2) > i; i++, p--) {
            v1 += cpf[i] * p; 
        } 
        
        v1 = ((v1 * 10) % 11);
        
        if (v1 == 10) {
            v1 = 0; 
        }
        
        if (v1 != cpf[9]) {
            return false; 
        } 
        
        for (var i = 0, p = 11; (cpf.length - 1) > i; i++, p--) {
            v2 += cpf[i] * p; 
        } 
        
        v2 = ((v2 * 10) % 11);
        
        if (v2 == 10) {
            v2 = 0; 
        }
        
        if (v2 != cpf[10]) {
            return false; 
        } else {   
            return true; 
        }
    } else if (val.length == 18) {
        var cnpj = val.trim();
        
        cnpj = cnpj.replace(/\./g, '');
        cnpj = cnpj.replace('-', '');
        cnpj = cnpj.replace('/', ''); 
        cnpj = cnpj.split(''); 
        
        var v1 = 0;
        var v2 = 0;
        var aux = false;
        
        for (var i = 1; cnpj.length > i; i++) { 
            if (cnpj[i - 1] != cnpj[i]) {  
                aux = true;   
            } 
        } 
        
        if (aux == false) {  
            return false; 
        }
        
        for (var i = 0, p1 = 5, p2 = 13; (cnpj.length - 2) > i; i++, p1--, p2--) {
            if (p1 >= 2) {  
                v1 += cnpj[i] * p1;  
            } else {  
                v1 += cnpj[i] * p2;  
            } 
        } 
        
        v1 = (v1 % 11);
        
        if (v1 < 2) { 
            v1 = 0; 
        } else { 
            v1 = (11 - v1); 
        } 
        
        if (v1 != cnpj[12]) {  
            return false; 
        } 
        
        for (var i = 0, p1 = 6, p2 = 14; (cnpj.length - 1) > i; i++, p1--, p2--) { 
            if (p1 >= 2) {  
                v2 += cnpj[i] * p1;  
            } else {   
                v2 += cnpj[i] * p2; 
            } 
        }
        
        v2 = (v2 % 11); 
        
        if (v2 < 2) {  
            v2 = 0;
        } else { 
            v2 = (11 - v2); 
        } 
        
        if (v2 != cnpj[13]) {   
            return false; 
        } else {  
            return true; 
        }
    } else {
        return false;
    }
 }
 $( document ).ready(function() {

  jQuery('.tp-juridica').hide();
  jQuery('#tipodepessoa').on('change', function() {
    changetpessoa()

    function changetpessoa(){
      
        var tp = jQuery('#tipodepessoa').val();
        jQuery('.tp-fisica').val('');
        jQuery('.tp-juridica').val('');
        if(tp === 'fisica'){
          setTimeout(function(){ 
            jQuery('.tp-fisica').show();
            jQuery('.tp-juridica').hide();

          }, 100);
        }else if(tp === 'juridica'){
          setTimeout(function(){ 
            jQuery('.tp-fisica').hide();
            jQuery('.tp-juridica').show();
          }, 100);
        }
      }
  });
});
 </script>