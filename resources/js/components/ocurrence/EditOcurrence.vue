<template>
    <div>
        <form method="POST" @submit="validateOcurrence" id="dados" >
                <h3 class="title text-center mb-1" id="novoModalLabel">Editar Ocorrência</h3>

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
                            <label for="Data">Data<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                                 
                            <input v-model="ocurrence.createdAt" type="date" class="form-control borda-input" placeholder="Selecione a data...">
                            <label v-if="errors.data" class="text-danger" v-cloak>{{errors.data}}</label>                           
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
                <span data-notify="title"></span> <span data-notify="message">Ocorrência atualizada com sucesso, voltando para <b>Ocorrências</b> em 3s</span>
            </div>
    </div>
</template>

<script>
export default {
    props: ['ocurrencecode'],
    data(){
        return{
            ocurrence: {
                code: null,
                description: '',
                createdAt: '',
                type: {
                    code: ''
                },
                user:{
                    code: ''
                }
            },
            typesocurrences: {},
            errors: {},        
            showAlert: false,
            buttonDisable: false,            
        }
    },
    methods: {
        validateOcurrence(e){
            e.preventDefault();
            this.errors = {};

            if(this.ocurrence.description && this.ocurrence.type.code && this.ocurrence.createdAt){
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
            if(!this.ocurrence.createdAt){
                this.errors.data = 'Este campo é obrigatório';
            }
            
            
        },
        async sendForm(){           
            try{                                                            
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
                this.ocurrence.code = JSON.parse(this.ocurrencecode);
                //const response = await axios.get(`https://sidespe-api.herokuapp.com/ocurrence/${this.ocurrence.code}`);   
                //this.ocurrence = {"code":1,"description":"Aluno fez muita raiva","createdAt":"2018-12-01","user":{"code":1},"type":{"code":1}}
                const response = await axios.get('https://sidespe-api.herokuapp.com/ocurrencetypes');   
                this.typesocurrences = response.data;
            }catch(err){
                console.log(err);
            }
    }
}
</script>
