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
                    <th>
                        Status
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
                    <td>
                        <span v-if="project.status == 'WAITING_FOR_APROVAL'">Aguardando Aprovação</span>
                        <span v-if="project.status == 'APPROVED'" class='text-success'>Aprovado</span>
                        <span v-if="project.status == 'PENDING'" class='text-warning'>Pendente</span>
                        <span v-if="project.status == 'REFUSED'" class='text-danger'>Recusado</span>
                    </td>
                    <td>
                        <a href="" data-toggle="modal" v-bind:data-target="'#detalhe'+project.code" >
                            Ver Detalhes
                        </a>
                    </td>

                    <!-- Inicio Modal --> 
                    <!-- Modal Detalhes --> 
                    <div class="modal fade" v-bind:id="'detalhe'+project.code" tabindex="-1" role="dialog" aria-labelledby="removerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                </div>
                            
                                <div class="modal-body ">
                                    <ul class="list-group">                                        
                                        <li class="list-group-item text-center"><h5 class="mb-0 mt-0">Projeto</h5></li>
                                        <li class="list-group-item text-center">{{project.name}}</li>
                                        <li class="list-group-item"><strong>Solicitante: </strong>Professor {{project.requesting.name}}</li>
                                        <li class="list-group-item"><strong>Resumo:</strong> {{project.summary}}</li>
                                        <li class="list-group-item"><strong>Data:</strong> {{project.requestedDate.split('-').reverse().join('-')}}</li>
                                        <li class="list-group-item" v-if="project.status == 'WAITING_FOR_APROVAL'"><strong>Status:</strong> <span>Aguardando Aprovação</span>
                                        </li>                                       
                                        <li class="list-group-item" v-if="project.status == 'APPROVED'"><strong>Status:</strong> <span class='text-success'>Aprovado</span>
                                        </li>
                                        <li class="list-group-item" v-if="project.status == 'PENDING'"><strong>Status:</strong> <span class='text-warning'>Pendente</span>
                                        </li>
                                        <li class="list-group-item" v-if="project.status == 'REFUSED'"><strong>Status:</strong> <span class='text-danger'>Recusado</span>
                                        </li>
                                        <li class="list-group-item">                                        
                                            <strong>Justificativas:</strong> 
                                            <a v-if="project.justifications.length > 0" href="#" data-toggle="modal" v-bind:data-target="'#justificativa'+project.code">Ver Justificativas</a>                                                                               
                                            <span v-else>Nenhuma justificativa adicionada pelo coordenador</span>
                                        </li>                                     
                                        <li class="list-group-item"><strong>Critérios Avaliativos:</strong> <br>
                                            <ol>
                                                <li v-for="criterio in project.criterions" v-bind:key="criterio.name">{{criterio.name}} ({{criterio.point}}).</li>
                                            </ol>    
                                        </li>
                                        <li class="list-group-item"><strong>Anexo:</strong> <a :href="'https://sidespe-api.herokuapp.com/projects/downloadFile/'+project.attachment.fileName" target="_blank">Ver Documento</a></li>                
                                    </ul>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <!-- Modal Justificativas -->
                    <div class="modal fade" v-bind:id="'justificativa'+project.code" tabindex="-1" role="dialog" aria-labelledby="removerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                </div>
                            
                                <div class="modal-body ">
                                    <ul class="list-group">                                        
                                        <li class="list-group-item text-center"><h5 class="mb-0 mt-0">Justificativas</h5></li>
                                        <li class="list-group-item" v-if="project.status == 'WAITING_FOR_APROVAL'"><strong>Status:</strong> <span>Aguardando Aprovação</span>
                                        </li>
                                        <li class="list-group-item" v-if="project.status == 'APPROVED'"><strong>Status:</strong> <span class='text-success'>Aprovado</span>
                                        </li>
                                        <li class="list-group-item" v-if="project.status == 'PENDING'"><strong>Status:</strong> <span class='text-warning'>Pendente</span>
                                        </li>
                                        <li class="list-group-item" v-if="project.status == 'REFUSED'"><strong>Status:</strong> <span class='text-danger'>Recusado</span>
                                        </li>
                                        <li class="list-group-item"><strong>Justificativas:</strong> <br/>                                                                                                                                
                                                <div class="modal-visualizar" style="max-height:300px;">
                                                <ol class="" v-for="justification in project.justifications" v-bind:key="justification.code">
                                                    <strong>Criado : {{justification.createdAt.split('-').reverse().join('-')}}</strong>
                                                    <li class="list-group-item">{{justification.description}}</li>
                                                </ol>
                                                </div>                                                                                                                                  
                                        </li>
                                     </ul>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fim Modal --> 
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
            localUser: localUser,
            justification: ''
        }
    },
    methods:{
        
    },
    async mounted(){           
            try{                                               
                const response = await axios.get(`https://sidespe-api.herokuapp.com/projects/${this.localUser.code}/teachers`);   
                this.projects = response.data;                
            }catch(err){
                console.log(err);
            }
    }
}
</script>

<style>

</style>
