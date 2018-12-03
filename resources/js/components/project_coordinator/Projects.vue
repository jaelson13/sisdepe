<template>
    <div>
        <div class="table-responsive">
             <div class="row">                                                                           
                <div class="form-group col-md-3">                            
                    <label for="Selecione o curso">Selecione o curso<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                    <select v-model="courseSelect" v-on:change="filtrarDados"  name="tipo" class="form-control borda-input" >
                        <option value="">Selecione o curso...</option>
                        <option v-for="course in courses" v-bind:key="course.code" :value=course.code>{{course.name}}</option>                                                                
                    </select>
               </div>
            </div>
            <table class="table table-striped" style="margin-bottom: 60px;">
                <thead class="text-primary">
                <tr>
                    <th>
                        Nome
                    </th>
                    <th>
                        Solicitante
                    </th>
                    <th>
                        Data
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="project in projects" v-bind:key="project.code">                                   
                    <td >
                        {{project.name}}
                    </td>
                    <td>
                        Professor {{project.requesting.name}}
                    </td>
                    <td>
                        {{project.requestedDate.split('-').reverse().join('-')}}
                    </td>
                   
                    <td>
                        <a href="#" data-toggle="modal" v-bind:data-target="'#detalhe'+project.code">
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
                                        <button data-toggle="modal" v-bind:data-target="'#status'+project.code" class="btn btn-sm btn-primary float-right">Atualizar Status</button>                                                                       
                                        </li>                                       
                                        <li class="list-group-item" v-if="project.status == 'APPROVED'"><strong>Status:</strong> <span class='text-success'>Aprovado</span>
                                         <button data-toggle="modal" v-bind:data-target="'#status'+project.code" class="btn btn-sm btn-primary float-right">Atualizar Status</button>
                                        </li>
                                        <li class="list-group-item" v-if="project.status == 'PENDING'"><strong>Status:</strong> <span class='text-warning'>Pendente</span>
                                         <button data-toggle="modal" v-bind:data-target="'#status'+project.code" class="btn btn-sm btn-primary float-right">Atualizar Status</button>
                                        </li>
                                        <li class="list-group-item" v-if="project.status == 'REFUSED'"><strong>Status:</strong> <span class='text-danger'>Recusado</span>
                                         <button data-toggle="modal" v-bind:data-target="'#status'+project.code" class="btn btn-sm btn-primary float-right">Atualizar Status</button>
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
                    <!-- Modal Status -->
                    <div class="modal fade" v-bind:id="'status'+project.code" tabindex="-1" role="dialog" aria-labelledby="removerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                </div>                            
                                <div class="modal-body ">
                                    <ul class="list-group">                                        
                                        <li class="list-group-item text-center"><h6 class="mb-0 mt-0">Projeto</h6></li>
                                        <li>
                                            <label for="Status">Status<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                                            <select v-model="project.status" name="tipo" class="form-control borda-input" >
                                                <option value="">Selecione o status...</option>
                                                <option value="WAITING_FOR_APROVAL">Aguardando Aprovação</option>
                                                <option value="PENDING">Pendente</option>                                                                
                                                <option value="APPROVED">Aprovado</option>                                                                
                                                <option value="REFUSED">Recusado</option>                                                                
                                            </select>
                                        
                                            <label for="Justificativa">Justificativa</label>                                     
                                            <textarea v-model='justification.description' class="form-control borda-input" name="descricao" placeholder="Justicação..." id="descricao" maxlength="255"></textarea>                                                    
                                                
                                            <br>                                            
                                            <button class="btn btn-sm btn-primary float-right" v-on:click="atualizarStatus(project)" data-dismiss="modal">Atualizar Status</button>                                                                                   
                                        </li>
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
                                        <li class="list-group-item"><strong>Justificativas:</strong> <br>                                                                                 
                                                <ol v-for="justification in project.justifications" v-bind:key="justification.code">
                                                    <li>{{justification.description}}</li>
                                                </ol>                                                                                  
                                        </li>
                                     </ul>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fim Modal --> 
                </tr>

                <tr v-if="projects.length === 0" >
                    <td colspan="4">Nenhum projeto foi encontrado.</td>
                </tr>

                </tbody>

            </table>
        </div>
        <div v-if="showAlert" data-notify="container" class="col-4 mx-auto alert alert-success" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
                <span data-notify="title"></span> <span data-notify="message">Justificativa adicionada com sucesso, <b>Atualizando Página</b> em 3s</span>
        </div>
    </div>
</template>

<script>
import localUser from '../util/LOCALUSER';
export default {
    data(){
        return {
            projects: [],
            courses: [],            
            courseSelect: '',
            justification: {},
            localUser: localUser,
            showAlert: false
        }
    },
    methods:{
       async filtrarDados(){
            try {                                
                const response = await axios.get(`https://sidespe-api.herokuapp.com/projects/courses/${this.courseSelect}`);   
                if(response.status === 200){
                this.projects = response.data.sort((a,b) => new Date(a.requestedDate) - new Date(b.requestedDate));                
                }
                if(response.status === 204){
                    this.projects = []
                }
            } catch (err) {
                console.log(err)
            }
        },
        async atualizarStatus(project){
            try {                                               
                const response = await axios.put(`https://sidespe-api.herokuapp.com/projects/${project.code}`, project);   
                if(response.status === 201){
                    this.showAlert = true;
                    setTimeout(() => {
                        window.location.href='/projetos';                        
                    }, 3000); 
                }                     
                if(this.justification.description){
                    const response2 = await axios.put(`https://sidespe-api.herokuapp.com/projects/${project.code}/justifications`, [this.justification]);   
                    if(response2.status === 201){
                    console.log('Justification atualizado')
                    }            
                }
            } catch (err) {
                console.log(err.response)
            }
        } 
    },
    async mounted(){           
            try{    
                const response = await axios.get(`https://sidespe-api.herokuapp.com/courses/${this.localUser.code}/users`);   
                this.courses = response.data;                                             
                               
            }catch(err){
                console.log(err);
            }
    }
}
</script>

<style>

</style>
