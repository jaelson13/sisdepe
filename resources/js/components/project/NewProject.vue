<template>
    <div>
        <form method="POST" @submit="validateProject" id="dados" >
                <h3 class="title text-center mb-1" id="novoModalLabel">Novo Projeto</h3>

                <div class="modal-body">
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Nome">Nome<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                     
                            <input v-model="project.name" type="text" class="form-control borda-input" placeholder="Tipo de ocorrência...">
                            <label v-if="errors.name" class="text-danger" v-cloak>{{errors.name}}</label>
                        </div>
                    </div>                
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Resumo">Resumo<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                     
                            <textarea v-model='project.summary' class="form-control borda-input" name="descricao" placeholder="Resumo..." id="descricao" maxlength="255"></textarea>
                             <label v-if="errors.summary" class="text-danger" v-cloak>{{errors.summary}}</label>
                        </div>
                    </div>     
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Critérios">Critérios:</label>                                                                 
                            <a data-toggle="modal" data-target="#filtrar" href="">Adicionar Critérios</a>                              
                            <div>                         
                                <ol>
                                    <li v-for="criterio in project.criterions" v-bind:key='criterio.name'>{{criterio.name}} ({{criterio.point}}) <a v-on:click="removeItemCriterions(criterio,$event)" class="text-danger ml-5" href="">X</a></li>
                                </ol>
                            </div>
                            <label v-if="errors.criterions" class="text-danger" v-cloak>{{errors.criterions}}</label>
                        </div>
                    </div>                             
                    <div class="row">                                                                           
                            <div class="form-group col-md-9 mx-auto">                            
                                <label for="Curso">Curso<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                                <select v-on:change="gradeUpdate" v-model="project.course.code" name="tipo" class="form-control borda-input" >
                                    <option value="">Selecione o tipo...</option>
                                    <option v-for="course in courses" v-bind:key="course.code" :value=course.code>{{course.name}}</option>                                                                
                                </select>
                                <label v-if="errors.course" class="text-danger" v-cloak>{{errors.course}}</label>   
                            </div>
                    </div>
                    <div class="row">                                                                           
                            <div class="form-group col-md-9 mx-auto">                            
                                <label for="Turma">Turma<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                                <select v-model="project.grade.code" name="tipo" class="form-control borda-input" >
                                    <option value="">Selecione o tipo...</option>
                                    <option v-for="grade in grades" v-bind:key="grade.code" :value=grade.code>{{grade.name}}</option>                                                                
                                </select>
                                <label v-if="errors.grade" class="text-danger" v-cloak>{{errors.grade}}</label>   
                            </div>
                    </div>
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Data">Data<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                                 
                            <input v-model="project.requestedDate" type="date" class="form-control borda-input" placeholder="Selecione a data...">
                            <label v-if="errors.requestedDate" class="text-danger" v-cloak>{{errors.requestedDate}}</label>                           
                        </div>
                    </div>
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Anexo">Anexo<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                                 
                            <br>
                            <label class="btn btn-sm btn-default mt-1 mr-2 text-white">
                                Selecione o anexo<input v-on:change="handleFileUpload" ref="file" type="file">
                            </label><label>{{file.name}}</label>
                            <br>
                            <label v-if="errors.attachment" class="text-danger" v-cloak>{{errors.attachment}}</label>                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mx-auto" style="margin-bottom: 10px;">                                    
                            <input type="submit" id="cadastrar" name="cadastrar" class="btn btn-modal col-md-2 text-center float-right mr-2" value="Cadastrar" :disabled="buttonDisable"><br>
                        </div>                      
                    </div>
                    <div class="row">
                        <div class="col-md-9 mx-auto text-center">
                            <label v-if="errors.button" class="text-danger" v-cloak>{{errors.button}}</label>
                        </div>
                    </div>
                </div>
            </form>

            <div v-if="showAlert" data-notify="container" class="col-4 mx-auto alert alert-success" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
                <span data-notify="title"></span> <span data-notify="message">Projeto cadastrado com sucesso, voltando para <b>Projetos</b> em 3s</span>
            </div>


        <div class="modal fade" id="filtrar" tabindex="-1" role="dialog" aria-labelledby="filtrarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body modal-visualizar">
                        <h5 class="text-center">Adicionar Critério</h5>
                        <div class="row">                                                        
                            <div class="form-group col-md-9 mx-auto">
                                <label for="Critério">Critério<span class="text-danger f-16" title="Campo obrigatório">*</span></label> 
                                <input v-model="criterioName" type="text" class="form-control borda-input" placeholder="Critério...">                                
                            </div>
                        </div>
                        <div class="row">                                                        
                            <div class="form-group col-md-9 mx-auto">
                                <label for="Pontos">Pontos<span class="text-danger f-16" title="Campo obrigatório">*</span></label> 
                                <input v-model="criterioPoint" type="number" class="form-control borda-input">                                                        
                            </div>
                        </div>
                        <label v-if="errors.criterio" class="text-danger text-center" v-cloak>{{errors.criterio}}</label> 
                    </div>   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" v-on:click="addCriterion">Add</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import localUser from '../util/LOCALUSER';
export default {
    data(){
        return{
            project: {
                name: '',
                summary: '',
                status: 'WAITING_FOR_APROVAL',
                course: {
                    code: ''
                },
                grade: {
                    code: ''
                },
                requesting: {
                    code: ''
                },
                requestedDate: '',
                criterions: [],
                attachment: {}
            },
            courses: [],
            grades: [],
            //Criterios
            criterioName: '',
            criterioPoint: '',
            //Arquivo
            file: '', 
            formData: '',           
            //Erros
            errors: {},        
            showAlert: false,
            buttonDisable: false,  
            //User auth
            localUser: localUser          
        }
    },
    methods: {
        validateProject(e){
            e.preventDefault();
            this.errors = {};         
            if(this.project.name && this.project.summary && this.project.course.code && this.project.grade.code && this.project.requestedDate && this.project.criterions.length>0 && this.formData){
                this.buttonDisable = true;
                this.sendForm()
            }else{
                this.errors.button = 'Preencha os campos obrigatórios';
            }            
            if(!this.project.name){
                this.errors.name = 'Este campo é obrigatório';
            }
            if(!this.project.summary){
                this.errors.summary = 'Este campo é obrigatório';
            }
            if(!this.project.course.code){
                this.errors.course = 'Este campo é obrigatório';
            }
            if(!this.project.grade.code){
                this.errors.grade = 'Este campo é obrigatório';
            }
            if(!this.project.requestedDate){
                this.errors.requestedDate = 'Este campo é obrigatório';
            }
            if(this.project.criterions.length < 1){
                this.errors.criterions = 'Este campo é obrigatório';
            }
            if(!this.formData){
                this.errors.attachment = 'É necessário adicionar o anexo do projeto';
            }
            
            
        },
        addCriterion(){  
            this.errors = {}         
            if(this.criterioName && this.criterioPoint){
                this.project.criterions.push({name: this.criterioName, point: this.criterioPoint});
                this.criterioName = '';
                this.criterioPoint = '';
            }else{
                this.errors.criterio = 'Preencha os campos obrigatórios';
            }                               
        },
        removeItemCriterions(criterion,e){
            e.preventDefault()        
            this.project.criterions.splice(this.project.criterions.indexOf(criterion),1);            
        },
        gradeUpdate(){               
            this.grades = []         
            this.project.grade.code = ''
            this.courses.forEach(course => {                   
                if(course.code == this.project.course.code){
                    course.grades.forEach(grade => {                        
                        this.grades.push(grade)
                    })
                }                                    
            }); 
        },
        async handleFileUpload() {
            this.file = this.$refs.file.files[0];         
            if(this.file.type != 'application/pdf' && this.file.type != 'application/msword' && this.file.type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
                this.errors.attachment = ''
                this.errors.attachment = "Arquivo não adicionado ou suportado, obs: Só são aceitor arquivos pdf e word"
            }else{
                this.errors.attachment = ''
                this.formData = new FormData();
                this.formData.append('file', this.file)                                  
            }
           
        },
        async sendForm(){           
            try{   
                this.project.requesting.code = this.localUser.code;        
                const response = await axios.post('https://sidespe-api.herokuapp.com/projects/uploadFile', this.formData)
                this.project.attachment = response.data;                                                                            
                const response2 = await axios.post("https://sidespe-api.herokuapp.com/projects", this.project);                                           
                if(response2.status === 201){                    
                    this.showAlert = true;
                    setTimeout(() => {
                        window.location.href='/projects';                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
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
