<template>
    <div>
        <form method="PUT" @submit="validateGrade" id="dados">            
            <h3 class="title text-center mb-1" id="novoModalLabel">Nova Turma</h3>

            <div class="modal-body">
                <div class="row">                                                        
                    <div class="form-group col-md-9 mx-auto">
                        <label for="Nome da turma">Nome da turma<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                       
                        <input v-model="grade.name" type="text" class="form-control borda-input" name="nome" placeholder="Nome do curso">
                        <label v-if="errors.name" class="text-danger" v-cloak>{{errors.name}}</label>                            
                    </div>
                </div>
                 <div class="row">                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Período">Período<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                
                            <input v-model="grade.period" type="number" class="form-control borda-input" name="nome" placeholder="Nome do curso">
                            <label v-if="errors.period" class="text-danger" v-cloak>{{errors.period}}</label>                                                        
                        </div>                                                       
                </div>

                <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Turno">Turno<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                            <select v-model="grade.shift" name="tipo" class="form-control borda-input" >
                                <option value="">Selecione o turno...</option>
                                <option value="MORNING_SHIFT">Manhã</option>                                
                                <option value="NIGHT_SHIFT">Noite</option>
                                <option value="DAY_SHIFT">Integral</option>
                            </select>
                            <label v-if="errors.shift" class="text-danger" v-cloak>{{errors.shift}}</label>   
                        </div>
                </div>  

                <div class="row">
                    <div class="col-md-9 mx-auto" style="margin-bottom: 10px;">                                    
                            <input type="submit" id="cadastrar" name="cadastrar" class="btn btn-modal col-md-2 text-center float-right mr-2" value="Cadastrar" :disabled="buttonDisable"><br>
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
            <span data-notify="title"></span> <span data-notify="message">Turma cadastrada com sucesso, voltando para <b>Turmas</b> em 3s</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['coursecode'],
    data(){
        return {
            grade: {
                name: '',
                period: '',
                shift: ''
            },
            course: {},
            errors: {},
            showAlert: false,
            buttonDisable: false
        }
    },
    methods:{
         validateGrade(e){
           e.preventDefault();
            this.errors = {};

            if(this.grade.name && this.grade.period && this.grade.shift){
                this.buttonDisable = true;
                this.sendForm()
            }else{
                this.errors.button = 'Preencha os campos obrigatórios';
            }            

            if(!this.grade.name){
                this.errors.name = 'Este campo é obrigatório';
            }
            if(!this.grade.period){
                this.errors.period = 'Este campo é obrigatório';
            }
            if(!this.grade.shift){
                this.errors.shift = 'Este campo é obrigatório';
            }
        },
        async sendForm(){           
            try{    
                const grade = [this.grade]
                const coursecode = JSON.parse(this.coursecode)                              
                const response = await axios.put(`https://sidespe-api.herokuapp.com/courses/${coursecode}/grades`, grade);                                           
                if(response.status === 201){
                    this.showAlert = true;
                    setTimeout(() => {
                        window.location.href=`/courses/${coursecode}/grades`;                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
            }            
        }
    }
}
</script>
