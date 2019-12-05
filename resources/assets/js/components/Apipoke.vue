<template>
    <div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <div v-if="vista==0" class="card-panel row">
            <div class="col s12">
                    <h1>Ingresar Usuario</h1>
                    <input v-model="name" class="col s10 offset-s1" type="text" placeholder="Ingresar Nombre de Entrenador">
                    <input v-model="password" class="col s10 offset-s1" type="password" placeholder="Ingresar Contraseña">
                    <input  class="btn col s2 offset-s5 center-align" type="button" value="Ingresar" @click="entrar()">
                    <p class="col s11 offset-s1">No tienes usuario?<a href="#" @click="registrar()"> Registrate</a></p>
            </div>
        </div>
        <div v-if="vista==2" class="card-panel row">
            <div class="col s12">
                <h3>{{name}}</h3>
                <h1>Equipo Pokemon</h1>
                <div class="col s2 center-align" v-for="poke in equipocom" :key="poke">
                    <entrenador :nombre="poke"/>
                </div>
                <input class="btn col s2 offset-s5 center-align" type="button" value="Editar" @click="editar()">
            </div>
        </div>
        <div v-if="vista==1" class="card-panel row">
            <div class="col s12">
                <h1>Nuevo entrenador</h1>
                <input class="col s6" type="file" name="" id="">
                <input v-model="password" class="col s5 offset-s1" type="password" placeholder="Ingresar Contraseña">
                <input v-model="name" class="col s5" type="text" placeholder="Ingresar Nombre de Entrenador">
                <input class="col s5 offset-s2" type="password" placeholder="Confirmación de Contraseña">
            </div>
            <button class="btn-large right" @click="entrarnuevo()">Aceptar</button>
        </div>
        <div v-if="vista==4" class="card-panel row">
            <div class="col s12">
                <div class="col s2 center-align" v-for="poke in equipo" :key="poke">
                    <equipokemon :nombre="poke" @eliminar="eliminardeequipo"/>
                </div>
            </div>
            <button class="btn-large right" @click="editarequipo()">Aceptar</button>
            <table>
                <thead>
                    <tr>
                        <th>N. Pokedex</th>
                        <th>Nombre</th>
                        <th>Apariencia</th>
                        <th>Tipos</th>
                        <th>Habilidades</th>
                        <th>Estadisticas</th>
                    </tr>
                </thead>
                <tbody v-for="poke in pokemon" :key="poke">
                        <pokesprite :nombre="poke.name" @enviar="agregaraequipo"/>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            pokemon: null,
            equipo: [],
            aux: 0,
            name :null,
            password:null,
            equipocom: [],
            comple:0,
            vista: 0,
            url: 'https://pokeapi.co/api/v2/pokemon/?limit=30&offset=700'
        };
    },
    mounted(){
        this.mostrar();
    },
    methods:{
        mostrar(){
            axios
                .get(this.url)
                    .then(response => {
                        this.pokemon = response.data.results
                    })
        },
        agregaraequipo(valor){
            if(this.equipo.length<6){
            for (let i = 0; i < this.equipo.length; i++) {
                const ele = this.equipo[i];
                if (ele == valor) {
                    this.aux = 1;
                }
            }
            if (this.aux !=1) {
                this.equipo.push(valor);
            }
            this.aux = 0;
            }
        },
        registrar(){
            this.vista = 1
        },
        entrar(){
            axios.post('http://127.0.0.1:8000/poke',{
                name:this.name,
                password:this.password
            }).then(response =>{
                console.log(response.data);
                if (response.data=='si') {
                    axios.post('http://127.0.0.1:8000/cargarpokes',{
                    name:this.name,
                    equipo:this.equipocom
                    }).then(response =>{
                        console.log(response.data); 
                        this.equipocom=[];
                        if (response.data.p1!=null) {
                            this.equipocom.push(response.data.p1);
                        }
                        if (response.data.p2!=null) {
                            this.equipocom.push(response.data.p2);
                        }
                        if (response.data.p3!=null) {
                            this.equipocom.push(response.data.p3);
                        }
                        if (response.data.p4!=null) {
                            this.equipocom.push(response.data.p4);
                        }
                        if (response.data.p5!=null) {
                            this.equipocom.push(response.data.p5);
                        }
                        if (response.data.p6!=null) {
                            this.equipocom.push(response.data.p6);
                        }
                        
                        
                    })
                    .catch(function(err){
                        console.log(err);
                    });
                    this.vista = 2
                }   
            })
            .catch(function(err){
                console.log(err);
            });
            
            
        },
        entrarnuevo(){
                axios.post('http://127.0.0.1:8000/trainer',{
                name:this.name,
                password:this.password
                }).then(res =>{
                    console.log(res.data);
                    if (res.data=='si') {
                        this.vista = 2; 
                    }
                })
                .catch(function(err){
                    console.log(err);
                });
            this.equipocom = this.equipo;
        },
        editarequipo(){
            this.equipocom = this.equipo;
            this.comple=6-this.equipocom.length;
            for (let ind = 0; ind < this.comple; ind++) {
                this.equipocom.push(null);
            }
            console.log(this.comple);
            axios.post('http://127.0.0.1:8000/editarpokes',{
            name:this.name,
            equipo:this.equipocom
            }).then(response =>{
                console.log(response.data); 
                this.equipocom=[];
                        if (response.data[0]!=null) {
                            this.equipocom.push(response.data[0]);
                        }
                        if (response.data[1]!=null) {
                            this.equipocom.push(response.data[1]);
                        }
                        if (response.data[2]!=null) {
                            this.equipocom.push(response.data[2]);
                        }
                        if (response.data[3]!=null) {
                            this.equipocom.push(response.data[3]);
                        }
                        if (response.data[4]!=null) {
                            this.equipocom.push(response.data[4]);
                        }
                        if (response.data[5]!=null) {
                            this.equipocom.push(response.data[5]);
                        }
                        console.log(this.equipocom);
            })
            .catch(function(err){
                console.log(err);
            });
            this.vista = 2; 
        },
        editar(){
            this.vista = 4;
            this.equipo = this.equipocom
        },
        eliminardeequipo(a){
            for (let index = 0; index < this.equipo.length; index++) {
                const element = this.equipo[index];
                if (element == a) {
                    this.equipo.splice(index, 1);
                }
                
            }
        }
    }
    
}
</script>
<style>

</style>