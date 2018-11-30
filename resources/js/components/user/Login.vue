<template>
    <div>
<div class="row justify-content-center align-items-center rounded" style="height:100vh;">
        <div class="col-5">
            <div class="card">
                <form @submit="validateUser" action="/home">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-12">
                                <h3 class="text-center" style="font-family: 'roboto', cursive;">SISDEPE</h3>
                            </div>
                        </div>

                        <div class="row">                                                        
                                <div class="form-group col-md-9 mx-auto">
                                    <label for="Email ou Login">Email ou Login<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                       
                                    <input v-model="user.login" type="text" class="form-control borda-input" name="nome" placeholder="Email ou Login">
                                    <label v-if="errors.login" class="text-danger" v-cloak>{{errors.login}}</label>                            
                                </div>
                        </div>
                        <div class="row">                                                        
                                <div class="form-group col-md-9 mx-auto">
                                    <label for="Senha">Senha<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                       
                                    <input v-model="user.password" type="password" class="form-control borda-input" name="nome" placeholder="Senha">
                                    <label v-if="errors.password" class="text-danger" v-cloak>{{errors.password}}</label>                            
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 mx-auto" style="margin-bottom: 10px;">                                    
                                <input type="submit" id="entrar" name="entrar" class="btn btn-modal form-control borda-input" value="Entrar">
                            </div>                      
                        </div>
                        <div class="row">
                            <div class="col-md-9 mx-auto text-center">
                                <label v-if="errors.button" class="text-danger" v-cloak>{{errors.button}}</label>
                            </div>
                        </div>  
                                                     
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
</template>

<script>
export default {
    data(){
        return{
            user:{ login: '',
                password: ''},
            errors: {}
        }
    },
    methods: {
        validateUser(e){
            e.preventDefault();
            this.errors = {};

            if(this.user.login && this.user.password){
                this.authenticate();
            }else{
                this.errors.button = 'Preencha os campos obrigatórios';
            }            
            if(!this.user.login){
                this.errors.login = 'Este campo é obrigatório';
            }
            if(!this.user.password){
                this.errors.password = 'Este campo é obrigatório';
            }
            
        },
        async authenticate(){           
            document.cookie = "isLogging=true;expires=Fri, 31 Dec 9999 23:59:59 GMT";
            alert(document.cookie);
            
            const user = {
                code: 1,
                name: "Jaelson",
                type: "COORDINATOR"
            }

            localStorage.setItem('user',JSON.stringify(user));
            window.location.href='/home';  
            //document.cookie = "isLogging=;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
            //alert(document.cookie);
            
            /*
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
            } */           
        }

    }
}
</script>