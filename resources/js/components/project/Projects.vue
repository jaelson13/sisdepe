<template>
    <div>
        <div class="table-responsive">
            <table class="table table-striped" style="margin-bottom: 60px;">
                <thead class="text-primary">
                <tr>
                    <th class="td">
                        Nome
                    </th>
                    <th>
                        Resumo
                    </th>
                    <th>
                        Data do Projeto
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="project in projects" v-bind:key="project.code">
                    
                    <td>
                        {{project.name}}
                    </td>
                    <td>
                        {{project.summary}}
                    </td>
                    <td>
                        {{project.requestedDate.split('-').reverse().join('-')}}
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

                <tr v-if="projects.length === 0" >
                    <td colspan="5">Nenhum projeto foi encontrado.</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import localUser from '../util/LOCALUSER';
export default {
    data(){
        return {
            projects: [],
            localUser: localUser
        }
    },
    methods:{
        
    },
    async mounted(){           
            try{                                               
                const response = await axios.get(`https://sidespe-api.herokuapp.com/projects/${this.localUser.code}/teachers/`);   
                this.ocurrences = response.data;                
            }catch(err){
                console.log(err);
            }
    }
}
</script>

<style>

</style>
