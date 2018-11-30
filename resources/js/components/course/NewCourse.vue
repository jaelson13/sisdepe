<template>
    <div>
        <form method="POST" @submit="validateCurso" id="dados">            
            <h3 class="title text-center mb-1" id="novoModalLabel">Novo Curso</h3>

            <div class="modal-body">
                <div class="row">                                                        
                    <div class="form-group col-md-9 mx-auto">
                        <label for="Nome do curso">Nome do curso<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                       
                        <input v-model="course.name" type="text" class="form-control borda-input" value="<?php if(isset($curso)) echo $curso->nome ?>" name="nome" placeholder="Nome do curso">
                        <label v-if="errors.name" class="text-danger" v-cloak>{{errors.name}}</label>                            
                    </div>
                </div>
                 <div class="row">                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Descrição">Descrição<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                
                            <textarea v-model='course.description' class="form-control borda-input" name="descricao" placeholder="Descrição..." id="descricao" maxlength="255"></textarea>
                            <label v-if="errors.description" class="text-danger" v-cloak>{{errors.description}}</label>                                                        
                        </div>                                                       
                </div>  
                <div class="row">                                                                           
                        <div class="form-group col-md-9 mx-auto">                            
                            <label for="Coordenador">Coordenador<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                            <select v-model="coordinator" name="tipo" class="form-control borda-input" >
                                <option value="">Selecione o coordenador...</option>
                                <option v-for="coordinator in coordinators" v-bind:key="coordinator.code" :value=coordinator.code>{{coordinator.name}}</option>                                                                
                            </select>
                            <label v-if="errors.coordinator" class="text-danger" v-cloak>{{errors.coordinator}}</label>   
                        </div>
                </div> 

                <div class="row">
                    <div class="col-md-9 mx-auto" style="margin-bottom: 10px;">                                    
                            <input type="submit" id="cadastrar" name="cadastrar" class="btn btn-modal col-md-2 text-center float-right mr-2" value="Cadastrar"><br>
                    </div>                      
                </div>
                <div class="row">
                    <div class="col-md-9 mx-auto text-center">
                        <label v-if="errors.button" class="text-danger" v-cloak>@{{errors.button}}</label>
                    </div>
                </div>
            </div>
        </form>
        <div v-if="showAlert" data-notify="container" class="col-4 mx-auto alert alert-success" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
            <span data-notify="title"></span> <span data-notify="message">Curso cadastrado com sucesso, voltando para <b>Cursos</b> em 3s</span>
        </div>
        <div v-if="showAlertEmpity" data-notify="container" class="col-4 mx-auto alert alert-warning" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
            <span data-notify="title"></span> <span data-notify="message">É necessário haver ao menos um coordenador cadastrado no sistema para cadastrar um curso, redirecionando para <b>Novo Usuário</b></span>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            course: {
                name: '',
                description: '',                
            },
            coordinator: '',
            errors: {},
            showAlert: false,
            showAlertEmpity: false,
            coordinators: {}

        }
    },
    methods:{
         validateCurso(e){
           e.preventDefault();
            this.errors = {};

            if(this.course.name && this.course.description && this.coordinator){
                this.sendForm()
            }else{
                this.errors.button = 'Preencha os campos obrigatórios';
            }            
            if(!this.course.name){
                this.errors.name = 'Este campo é obrigatório';
            }
            if(!this.course.description){
                this.errors.description = 'Este campo é obrigatório';
            }
            if(!this.coordinator){
                this.errors.coordinator = 'Este campo é obrigatório';
            }
        },
        async sendForm(){           
            try{       
                this.course.users = [{code: this.coordinator}]
                const response = await axios.post("https://sidespe-api.herokuapp.com/courses", this.course);                                           
                if(response.status === 201){
                    this.showAlert = true;
                    setTimeout(() => {
                        window.location.href='/courses';                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
            }            
        }
    },
    async mounted(){
        try{                             
            const response = await axios.get("https://sidespe-api.herokuapp.com/users/coordinators");       
            this.coordinators = response.data;    
            if(!this.coordinators){
                    this.showAlertEmpity = true;
                    setTimeout(() => {
                        window.location.href='/new_user';                        
                    }, 6500); 
            }                                               
        }catch(err){
            console.log(err)
        }      
    }
}
</script>
