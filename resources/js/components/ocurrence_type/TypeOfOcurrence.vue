<template>
    <div>
        <div class="table-responsive">
            <table class="table table-striped" style="margin-bottom: 60px;">
                <thead class="text-primary">
                <tr>
                    <th class="td">
                        Tipos de Ocorrência
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="ocurrence in ocurrences" v-bind:key="ocurrence.code">
                    
                    <td>
                        {{ocurrence.name}}
                    </td>
                    <td class="float-right mr-3">
                        <a href="#" class="dropdown " data-toggle="dropdown">
                            <i class="material-icons">
                                more_horiz
                            </i>
                        </a>
                        <ul class="dropdown-menu" style="padding-left: 10px; " role="menu">
                            <li><a :href="'/edit_type_ocurrence/'+ocurrence.code">Editar</a></li>                            
                            <li><a href="#">Desativar Usuário</a></li>
                        </ul>

                    </td>
                </tr>

                <tr v-if="ocurrences.length === 0" >
                    <td colspan="5">Nenhum tipo de ocorrência foi encontrada.</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            ocurrences: [],
        }
    },
    methods:{
        
    },
    async mounted(){           
            try{                               
                const response = await axios.get('https://sidespe-api.herokuapp.com/ocurrencetypes');   
                this.ocurrences = response.data;
            }catch(err){
                console.log(err);
            }
    }
}
</script>

<style>

</style>
