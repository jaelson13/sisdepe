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
                            <textarea v-model='project.summary' class="form-control borda-input" name="descricao" placeholder="Descrição..." id="descricao" maxlength="255"></textarea>
                             <label v-if="errors.summary" class="text-danger" v-cloak>{{errors.summary}}</label>
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
                            <label for="Critérios">Critérios<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                                 
                            <br>
                            <label class="btn btn-sm btn-default mt-1 mr-2 text-white">
                                Selecione o anexo<input v-on:change="handleFileUpload" ref="file" type="file">
                            </label><label>{{file.name}}</label>
                            <br>
                            <label v-if="errors.criterions" class="text-danger" v-cloak>{{errors.criterions}}</label>                           
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
                <span data-notify="title"></span> <span data-notify="message">Ocorrência cadastrada com sucesso, voltando para <b>Ocorrências</b> em 3s</span>
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
                criterions: ''
            },
            courses: [],
            grades: [],
            file: '',
            errors: {},        
            showAlert: false,
            buttonDisable: false,  
            localUser: localUser          
        }
    },
    methods: {
        validateProject(e){
            e.preventDefault();
            this.errors = {};

            if(this.project.name && this.project.summary && this.project.course.code && this.project.grade.code && this.project.requestedDate && this.project.criterions){
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
            if(!this.project.criterions){
                this.errors.criterions = 'Este campo é obrigatório';
            }
            
            
        },
        gradeUpdate(){               
            this.grades = []         
            this.project.grade.code = ''
            this.courses.forEach(course => {                   
                if(course.code == this.project.course.code){
                    course.grades.forEach(grade => {
                        console.log(grade)
                        this.grades.push(grade)
                    })
                }                                    
            }); 
        },
        async handleFileUpload() {
            this.file = this.$refs.file.files[0];         
            if(this.file.type != 'application/pdf' && this.file.type != 'application/msword' && this.file.type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
                this.errors.criterions = ''
                this.errors.criterions = "Arquivo não adicionado ou suportado, obs: Só são aceitor arquivos pdf e word"
            }else{
                this.errors.criterions = ''
                try {
                    const formData = new FormData();
                    formData.append('file', this.file)                    
                    const response = await axios.post('http://localhost:8000/upload', formData)
                    console.log(response.data)
                } catch (error) {
                    console.log(error)
                }
                  //Verificar se fara o upload ou fará quando enviar.
            }
           
        },
        async sendForm(){           
            try{                                  
                this.ocurrence.user.code = this.localUser.code;                              
                const response = await axios.post("https://sidespe-api.herokuapp.com/ocurrences", this.ocurrence);                                           
                if(response.status === 201){                    
                    this.showAlert = true;
                    setTimeout(() => {
                        window.location.href='/ocurrences';                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
            }            
        }


    },
    async mounted(){           
            try{               
                const response = await axios.get('https://sidespe-api.herokuapp.com/courses');                   
                if(response.data){
                    response.data.forEach(course => {                   
                    if(course.users.findIndex(user => user.code == this.localUser.code) === 0){
                        this.courses.push(course)
                    }                                    
                    }); 
                }
            }catch(err){
                console.log(err);
            }
    }
}
</script>
