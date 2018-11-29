<template>
    <div>
        <form method="POST" @submit="validateOcurrenceTypes" id="dados" >
                <h3 class="title text-center mb-1" id="novoModalLabel">Editar Tipo de Ocorrência</h3>

                <div class="modal-body">
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Tipo">Tipo<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                     
                            <input v-model="typeocurrence.name" type="text" class="form-control borda-input" placeholder="Tipo de ocorrência...">
                            <label v-if="errors.name" class="text-danger" v-cloak>{{errors.name}}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 mx-auto" style="margin-bottom: 10px;">                                    
                        <input type="submit" id="cadastrar" name="cadastrar" class="btn btn-modal col-md-2 text-center float-right mr-2" value="Cadastrar"><br>
                    </div>                      
                </div>
                <div class="row">
                    <div class="col-md-9 mx-auto text-center">
                        <label v-if="errors.button" class="text-danger" v-cloak>{{errors.button}}</label>
                    </div>
                </div>
            </form>

            <div v-if="showAlert" data-notify="container" class="col-4 mx-auto alert alert-success" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
                <span data-notify="title"></span> <span data-notify="message">Tipo de ocorrência cadastrada com sucesso, voltando para <b>Tipos de Ocorrências</b> em 3s</span>
            </div>
    </div>
</template>

<script>
export default {
    props: ['typeocorrencecode'],
    data(){
        return{
            typeocurrence: {
                code: null,
                name: '',
            },
            errors: {},        
            showAlert: false
        }
    },
    methods: {
        validateOcurrenceTypes(e){
            e.preventDefault();
            this.errors = {};

            if(this.typeocurrence.name){
                this.sendForm()
            }else{
                this.errors.button = 'Preencha os campos obrigatórios';
            }            

            if(!this.typeocurrence.name){
                this.errors.name = 'Este campo é obrigatório';
            }
            
            
        },
        async sendForm(){           
            try{                              
                const response = await axios.post("https://sidespe-api.herokuapp.com/ocurrencetypes", this.typeocurrence);                                           
                if(response.status === 201){
                    this.showAlert = true;
                    setTimeout(() => {
                        window.location.href='/typesofocurrences';                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
            }            
        }

    },
    async mounted(){
             try{        
                this.typeocurrence.code = JSON.parse(this.typeocorrencecode);                      
                const response = await axios.get("https://sidespe-api.herokuapp.com/ocurrencetypes/"+this.typeocurrence.code);       
                console.log(response.data);
                this.typeocurrence = response.data;                                                    
            }catch(err){
                console.log(err)
            }      
        }

}
</script>
