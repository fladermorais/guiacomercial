<template>
  <div>
    
    <div class="d-flex justify-content-between">
        <a class="btn btn-primary col-md-3" v-if="criar" v-bind:href="criar">Novo</a>
        <a class="btn btn-primary" v-if="voltar" v-bind:href="voltar">Voltar</a>
        <a class="btn btn-outline-danger" v-if="inativos" v-bind:href="inativos">Excluidos</a>
      <span class="col">
        <input type="search" placeholder="Buscar" class="form-control" v-model="buscar">
      </span>
    </div>
    <br>
    <table class="table  table-hover">
      <thead>
        <tr>
          <th style="cursor:pointer" v-on:click="ordenaColuna(index)" v-for="(titulo, index) in titulos">{{titulo}}</th>

          <th v-if="detalhe || editar || deletar">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in lista" v-bind:class="{'alert alert-warning': item.cnt == 0}">

        <td v-for="(i, indice) in item">
          <!-- <span v-if="item.status == 'Aberto'" v-bind:class="{'badge badge-danger' : indice == 'status'}">{{i}}</span> -->
        
          <span v-if="item.priorities == 'Baixa'" v-bind:class="{' badge badge-secondary' : indice == 'priorities'}">{{i}}</span>
          <span v-else-if="item.priorities == 'Média'" v-bind:class="{'badge badge-info' : indice == 'priorities'}">{{i}}</span>
          <span v-else-if="item.priorities == 'Alta'" v-bind:class="{'badge badge-warning' : indice == 'priorities'}">{{i}}</span>
          <span v-else-if="item.priorities == 'Urgente'" v-bind:class="{'badge badge-danger' : indice == 'priorities'}">{{i}}</span>
          <span v-else >{{i}}</span>
        </td>
                    
          <td v-if="detalhe || editar || deletar || tags || ativar">
            <form v-if="deletar && token" v-bind:id="index" v-bind:action="deletar + item.id" method="post">
              <input type="hidden" name="_method" value="get">
              <input type="hidden" name="_token" v-bind:value="token">

              <a v-if="detalhe" v-bind:href="detalhe + item.id" class="btn btn-dark btn-sm" title="Visualizar"><i class="far fa-eye"></i></a>
              <a v-if="editar" v-bind:href="editar + item.id" class="btn btn-primary btn-sm" title="editar"><i class="fas fa-edit"></i></a>
              <a href="#" v-on:click="executaForm(index)" title="Inativar" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
              <a v-if="tags" v-bind:href="tags + item.id" class="btn btn-light btn-sm" title="Cadastrar Tags"><i class="fas fa-tags"></i></a>
            </form>

            <span v-else>
              <a v-if="detalhe" v-bind:href="detalhe + item.id" class="btn btn-dark btn-sm" title="Visualizar"><i class="far fa-eye"></i></a>
              <a v-if="editar" v-bind:href="editar + item.id" class="btn btn-primary btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
              <a v-if="ativar" v-bind:href="ativar + item.id" class="btn btn-warning btn-sm" title="Ativar"><i class="fas fa-check-square"></i></a>
            </span>
            <span>
              
            </span>
          </td>

        </tr>
      </tbody>

    </table>

  </div>

</template>

<script>
    export default {
      props:['titulos', 'itens', 'criar','deletar', 'ativar', 'voltar', 'tags', 'download', 'detalhe' ,'token','editar', 'ordem', 'ordemcol','modal', 'inativos'],
      data: function(){
        return{
          buscar:'',
          ordemAux: this.ordem || 'asc',
          ordemAuxCol: this.ordemcol || 0,
          css: 'teste',
        }
      },
      methods:{
        executaForm: function(index){
          document.getElementById(index).submit();
        }, // fim do executaForm
         ordenaColuna: function(coluna){
           this.ordemAuxCol = coluna;
           if(this.ordemAux.toLowerCase() == 'asc'){
             this.ordemAux = 'desc';
           } else {
             this.ordemAux = 'asc';
           }
         }, // Fim do ordenaColuna
      }, // Fim do methods

      computed:{
        lista:function(){

          let ordem = this.ordemAux;
          let ordemCol = this.ordemAuxCol;

          ordem = ordem.toLowerCase();
          ordemCol = parseInt(ordemCol);

          if(ordem == 'asc'){
            this.itens.sort(function(a,b){
              if(Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) {return 1;}
              if(Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) {return -1;}
              return 0;
            });
          }else {
            this.itens.sort(function(a,b){
              if(Object.values(a)[ordemCol] < Object.values(b)[ordemCol]){ return 1;}
              if(Object.values(a)[ordemCol] > Object.values(b)[ordemCol]){return -1;}
              return 0;
            })
          }

          if(this.buscar){
            return this.itens.filter(res => {
              res = Object.values(res);
              for(let k = 0; k < res.length; k++){
                if ((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
                  return true;
                }
              }
              return false;
            });
          }
          

          return this.itens;
        }
      }
    }
</script>