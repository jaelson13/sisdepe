<template>
    <div>
        <div class="card-header">
            <div class="row">
                <div class="col-md-7">
                    <h5 class="title pt-2">Adicionar usuários ao curso</h5>                    
                </div>
                <div class="col-md-5 pr-4">
                    <a class="btn btn-success float-right" href="" @click.prevent='addUsers' v-bind:disabled="(checkdados.length < 1)">Adicionar</a>
                </div>
            </div>
        </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 m-auto ">
                <div class="table-responsive">
                    <div class="row">                                                        
                        <div class="form-group float-right mr-3 col-3 "> 
                            <label for="Filtrar por login">Filtrar por login</label> 
                            <input onChange="filterUser" v-model="inputFilter" class="form-control borda-input" placeholder="Digite o login" style="height:30px;border-radius:5px;" href="#" data-toggle="modal" data-target="#filtrar"/>
                        </div>
                    </div>                                              
                    <table class="table table-striped" style="margin-bottom: 60px;">
                    <thead class="text-primary">
                    <tr>
                        <th>
                            #
                        </th>

                        <th class="td">
                            Nome
                        </th>

                        <th>
                            Login
                        </th>

                        <th>
                            Email
                        </th>

                    </tr>
                    </thead>
                    <tbody>                                                                       
                    <tr v-for="user in filterUser" v-bind:key="user.code">
                        <td>
                            <input v-model="checkdados" :value="user.code" type="checkbox" name="user" id="user">
                        </td>                        

                        <td>
                            {{user.name}}
                        </td>

                        <td>
                            {{user.login}}
                        </td>

                        <td>
                            {{user.email}}
                        </td>
                    </tr>

                    <tr v-if="users.length === 0">
                        <td colspan="5">Nenhuma usuário foi encontrada.</td>
                    </tr>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
        <div v-if="showAlert" data-notify="container" class="col-4 mx-auto alert alert-success" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
                <span data-notify="title"></span> <span data-notify="message">Usuários adicionados com sucesso ao curso, voltando para <b>Cursos</b> em 3s</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['coursecode'],
        data(){
            return {
                users:[],
                inputFilter: '',
                checkdados: [],
                codecourse: null,
                showAlert: false,
                usersJaAdd: []
            }
        },
        computed: {
            filterUser(){
                if(this.inputFilter){
                    const filterUsers = this.users.filter(user => user.login.toLowerCase().match(this.inputFilter.toLowerCase()));                    
                    return filterUsers;
                }else{
                    return this.users;
                }
            }
        },
        methods: {
            async addUsers(){                
                try{
                let users  = []
                this.checkdados.forEach(userCode => users.push({code: userCode}));                                          
                const response = await axios.put(`https://sidespe-api.herokuapp.com/courses/${this.codecourse}/teachers`, users);                                           
                if(response.status === 201){
                    this.showAlert = true;
                    setTimeout(() => {
                        window.location.href=`http://127.0.0.1:8000/courses/${this.codecourse}/users`;                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
            }   
            }
        },

        async mounted(){
            try{                        
                this.codecourse = JSON.parse(this.coursecode);
                const response = await axios.get("https://sidespe-api.herokuapp.com/users");                   
                
                const responseUsersCourse = await axios.get(`https://sidespe-api.herokuapp.com/courses/${this.codecourse}`)  
                responseUsersCourse.data.users.forEach(user => this.usersJaAdd.push(user.code)) 
                
                this.users = response.data;                                                                  
                if(this.usersJaAdd.length > 0){
                    this.usersJaAdd.forEach(userCode => {
                    this.users.splice(this.users.findIndex(user => user.code == userCode),1)
                })
            }             
            }catch(err){
                console.log(err)
            }      
        }
    }
</script>