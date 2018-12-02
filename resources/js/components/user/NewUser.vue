<template>
    <div>
        <form method="POST" @submit="validateUser" id="dados" >
                <h3 class="title text-center mb-1" id="novoModalLabel">Novo Usuario</h3>

                <div class="modal-body">
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Nome">Nome<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                     
                            <input v-model="user.name" type="text" class="form-control borda-input" placeholder="Nome...">
                            <label v-if="errors.name" class="text-danger" v-cloak>{{errors.name}}</label>
                        </div>
                    </div>
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Login">Login<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                       
                            <input v-on:change="verifyLogin" v-model="user.login" type="text" class="form-control borda-input" placeholder="Nome...">
                            <label v-if="errors.login" class="text-danger" v-cloak>{{errors.login}}</label>
                            <label v-if="success.login" class="text-success" v-cloak>{{success.login}}</label>
                        </div>
                    </div>
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Email">Email<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                       
                            <input v-on:change="verifyEmail" v-model="user.email" type="email" class="form-control borda-input" name="email" placeholder="Email..." id="email">
                            <label v-if="errors.email" class="text-danger" v-cloak>{{errors.email}}</label>
                            <label v-if="success.email" class="text-success" v-cloak>{{success.email}}</label>
                        </div>
                    </div>
                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Senha">Senha<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                       
                            <input v-model="user.password" type="password" class="form-control borda-input" name="senha" placeholder="Senha..." id="senha">
                            <label v-if="errors.password" class="text-danger" v-cloak>{{errors.password}}</label>
                        </div>
                    </div>

                    <div class="row">                                                        
                        <div class="form-group col-md-9 mx-auto">
                            <label for="Tipo de Usuário">Tipo de Usuário<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                                                               
                                <select v-model="user.type" name="tipo" class="form-control borda-input">
                                    <option value="">Selecione o tipo...</option>
                                    <option value="TEACHER">Professor</option>
                                    <option value="COORDINATOR">Coordenadaor</option>
                                    
                                </select>
                            <label v-if="errors.type" class="text-danger" v-cloak>{{errors.type}}</label>
                        </div>
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
            </form>

            <div v-if="showAlert" data-notify="container" class="col-4 mx-auto alert alert-success" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
                <span data-notify="title"></span> <span data-notify="message">Usuário cadastrado com sucesso, voltando para <b>Usuários</b> em 3s</span>
            </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            user: {
                name: '',
                login: '',
                email: '',
                password: '',
                type: '',
                active: true
            },
            errors: {},   
            success: {},     
            showAlert: false,
            buttonDisable: false,
            regexLogin: /^(?=.{6,20}$)[a-z][a-z0-9]+(?:-[a-z0-9]+)?$/i,
            regexEmail:  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        }
    },
    methods: {
        validateUser(e){
            e.preventDefault();
            this.errors = {};

            if(this.user.name && this.regexLogin.test(this.user.login) && this.regexEmail.test(this.user.email) && this.user.password && this.user.type){
                this.buttonDisable = true;
                this.sendForm()
            }else{
                this.errors.button = 'Preencha os campos obrigatórios';
            }            

            if(!this.user.name){
                this.errors.name = 'Este campo é obrigatório';
            }
            if(!this.user.login){
                this.errors.login = 'Este campo é obrigatório';
            }
            if(!this.regexLogin.test(this.user.login)){
                this.errors.login = 'Este campo deve conter entre 6 e 20 caracteres. ex: johndeep';
                this.success.login = ''
            }
            if(!this.regexEmail.test(this.user.email)){
                this.errors.email = 'Email inválido';
            }
            if(!this.user.password){
                this.errors.password = 'Este campo é obrigatório';
            }            
            if(!this.user.type){
                this.errors.type = 'Este campo é obrigatório';
            }
            
        },
        async sendForm(){           
            try{                              
                const response = await axios.post("https://sidespe-api.herokuapp.com/users", this.user);                                           
                if(response.status === 201){
                    this.showAlert = true;
                    setTimeout(() => {
                        window.location.href='/users';                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
            }            
        },
        async verifyLogin(){
           try{ 
               if(this.regexLogin.test(this.user.login)){                             
                    const response = await axios.get(`https://sidespe-api.herokuapp.com/users/verifylogin/${this.user.login}`); 
                    console.log(response.data)                                          
                    if(response.status === 204){
                        this.buttonDisable = false
                        this.success.login = 'Login válido!!'
                        this.errors.login = ''
                        this.$forceUpdate()
                    }
               }else{
                   this.errors.login = 'Este campo deve conter entre 6 e 20 caracteres. ex: johndeep';
                   this.success.login = ''
                   this.$forceUpdate()
               }
            }catch(err){
                console.log(err)
                if(err.response.status === 400){                    
                    this.errors.login = "Login já existente"
                    this.success.login = ''
                    this.buttonDisable = true
                    this.$forceUpdate()
                }
            }  
        },
        async verifyEmail(){
           try{          
                if(this.regexEmail.test(this.user.email)){                     
                    const response = await axios.get(`https://sidespe-api.herokuapp.com/users/verifyemail/${this.user.email}`); 
                    console.log(response.data)                                                          
                    if(response.status === 204){
                        this.buttonDisable = false
                        this.success.email = 'Email válido!!'
                        this.errors.email = ''
                        this.$forceUpdate()
                    }
                }else{
                   this.errors.email = 'Email inválido';
                   this.success.email = ''
                   this.$forceUpdate()
               }
            }catch(err){                
                console.log(err)
                if(err.response.status === 400){                    
                    this.errors.email = "Email já existente"
                    this.success.email = ''
                    this.buttonDisable = true
                    this.$forceUpdate()
                }
            }  
        }

    }
}
</script>
