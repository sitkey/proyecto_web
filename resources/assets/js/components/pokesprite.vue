<template>
  <tr>
    <td>{{pokeid}}</td>
    <td>{{nombre}}</td>
    <td>
      <img :src=pokespri.front_default>
    </td>
    <td>
      <div v-for="tipo in poketipo" :key="tipo">
        <p>{{tipo.type.name}}</p>
      </div>
    </td>
    <td>
      <div v-for="abi in pokeabi" :key="abi">
        <p>{{abi.ability.name}}</p>
      </div>
    </td>
    <td>
      <div v-for="esta in pokeesta" :key="esta">
        <p>{{esta.stat.name}}: {{esta.base_stat}}</p>
      </div>
    </td>
    <td><button class="btn" @click="enviarp(nombre)">Seleccionar</button></td>
  </tr>
</template>
    
<script>
import axios from 'axios'
export default {
  props: {
    nombre: {
      type: String
    }
  },
   data(){
        return{
            pokeabi: [],
            poketipo: [],
            pokeesta: [],
            pokeid: 0,
            pokespri: "",
            urlspri: "",
            url: 'https://pokeapi.co/api/v2/pokemon/'
        };
    },
    mounted(){
        this.pasar(this.nombre);
    },
  methods:{
    pasar(valor){
            this.urlspri=this.url+valor+"/";
            axios
                .get(this.urlspri)
                    .then(response => {
                        this.pokespri = response.data.sprites
                        this.pokeabi = response.data.abilities
                        this.poketipo = response.data.types
                        this.pokeesta = response.data.stats
                        this.pokeid = response.data.id
                    })
            
    },
    enviarp(valor){
      this.$emit('enviar', valor)
		}
  }
}
</script>