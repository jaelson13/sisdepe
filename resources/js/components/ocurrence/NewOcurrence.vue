<template>
    <div>
        <form method="POST" @submit="validateOcurrence" id="dados" >
                <h3 class="title text-center mb-1" id="novoModalLabel">Novo Tipo de Ocorrência</h3>

                <div class="modal-body">
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Descrição">Descrição<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                     
                            <input v-model="ocurrence.description" type="text" class="form-control borda-input" placeholder="Tipo de ocorrência...">
                            <label v-if="errors.description" class="text-danger" v-cloak>{{errors.description}}</label>
                        </div>
                    </div>                
                    <div class="row">                                                                           
                            <div class="form-group col-md-9 mx-auto">                            
                                <label for="Tipo">Tipo<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                                <select v-model="ocurrence.type.code" name="tipo" class="form-control borda-input" >
                                    <option value="">Selecione o tipo...</option>
                                    <option v-for="typeocurrence in typesocurrences" v-bind:key="typeocurrence.code" :value=typeocurrence.code>{{typeocurrence.name}}</option>                                                                
                                </select>
                                <label v-if="errors.typeocurrence" class="text-danger" v-cloak>{{errors.typeocurrence}}</label>   
                            </div>
                    </div>
                    <div class="row">                                                                           
                            <div class="form-group col-md-9 mx-auto">                            
                                <label for="Curso">Curso<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                                <select v-model="ocurrence.course.code" name="tipo" class="form-control borda-input" >
                                    <option value="">Selecione o curso...</option>
                                    <option v-for="course in courses" v-bind:key="course.code" :value=course.code>{{course.name}}</option>                                                                
                                </select>
                                <label v-if="errors.course" class="text-danger" v-cloak>{{errors.course}}</label>   
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
            ocurrence: {
                description: '',
                createdAt: new Date().toISOString().split('T')[0],
                type: {
                    code: ''
                },
                requesting:{
                    code: ''
                },
                course: {
                    code: ''
                }
            },
            typesocurrences: {},
            courses: {},
            errors: {},        
            showAlert: false,
            buttonDisable: false,            
            localUser: localUser
        }
    },
    methods: {
        validateOcurrence(e){
            e.preventDefault();
            this.errors = {};

            if(this.ocurrence.description && this.ocurrence.type.code && this.ocurrence.course){
                this.buttonDisable = true;
                this.sendForm()
            }else{
                this.errors.button = 'Preencha os campos obrigatórios';
            }            

            if(!this.ocurrence.description){
                this.errors.description = 'Este campo é obrigatório';
            }
            if(!this.ocurrence.type.code){
                this.errors.typeocurrence = 'Este campo é obrigatório';
            }
            if(!this.ocurrence.course){
                this.errors.course = 'Este campo é obrigatório';
            }
            
            
        },
        async sendForm(){           
            try{                   
                this.ocurrence.requesting.code = this.localUser.code;                                         
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
                const response = await axios.get(`https://sidespe-api.herokuapp.com/courses/${this.localUser.code}/users`);   
                this.courses = response.data;
                const response2 = await axios.get('https://sidespe-api.herokuapp.com/ocurrencetypes');   
                this.typesocurrences = response2.data;
                if(!this.typesocurrences){
                    this.errors.typeocurrence = 'Não há tipos de ocorrências cadastradas, contate o administrador do sistema';
                }
            }catch(err){
                console.log(err);
            }
    }
}
</script>
