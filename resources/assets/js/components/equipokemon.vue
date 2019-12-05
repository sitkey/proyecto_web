<template>
    <div>
        <p>{{nombre}} <a class="btn-floating pulse red"><i class="material-icons" @click="eliminarp(nombre)">close</i></a></p>
        <img :src=pokespri.front_default>
    </div>
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
            pokespri: "",
            urlspri: "",
            url: 'https://pokeapi.co/api/v2/pokemon/'
        };
    },
    mounted(){
        if (this.nombre!=null) {
        this.pasar(this.nombre);
      }
    },
  methods:{
    pasar(valor){
            this.urlspri=this.url+valor+"/";
            axios
                .get(this.urlspri)
                    .then(response => {
                        this.pokespri = response.data.sprites
                    })
    },
    eliminarp(valor){
      this.$emit('eliminar', valor)
		}
  }                
}
</script>