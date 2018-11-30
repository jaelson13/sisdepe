<template>
    <div>
        <div class="table-responsive">
            <table class="table table-striped" style="margin-bottom: 60px;">
                <thead class="text-primary">
                <tr>
                    <th class="td">
                        Nome
                    </th>
                    <th>
                        Login
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Cargo
                    </th>
                    <th>
                        Status
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" v-bind:key="user.code">
                    <td>
                        {{user.name}}
                    </td>
                    <td>
                        {{user.login}}
                    </td>                    
                    <td>
                        {{user.email}}
                    </td>                    
                    <td v-if="user.type === 'TEACHER'">
                        Professor
                    </td>
                    <td v-if="user.type === 'COORDINATOR'">
                        Coordenador
                    </td>
                    <td v-if="user.active">
                        Ativo
                    </td>
                    <td v-else>
                        Desativado
                    </td>

                    <td>
                        <a href="#" class="dropdown " data-toggle="dropdown">
                            <i class="material-icons">
                                more_horiz
                            </i>
                        </a>
                        <ul class="dropdown-menu" style="padding-left: 10px; " role="menu">
                            <li><a :href="'/edit_user/'+user.code">Editar</a></li>                            
                            <li v-if="user.active"><a href="#" v-on:click="disableUser(user.code)">Desativar Usuário</a></li>
                            <li v-else><a href="#" v-on:click="activeUser(user.code)">Ativar Usuário</a></li>
                          </ul>

                    </td>
                </tr>

                <tr v-if="users.length === 0" >
                    <td colspan="5">Nenhum usuário foi encontrado.</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div v-if="showAlertDisable" data-notify="container" class="col-4 mx-auto alert alert-success" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
                <span data-notify="title"></span> <span data-notify="message">Usuário desativado com sucesso, atualizando <b> Lista de Usuários</b> em 3s</span>
        </div>
        <div v-if="showAlertEnable" data-notify="container" class="col-4 mx-auto alert alert-success" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1060; top: 20px; left: 0px; right: 0px;">
                <span data-notify="title"></span> <span data-notify="message">Usuário ativado com sucesso, atualizando <b> Lista de Usuários</b> em 3s</span>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            users: [],
            showAlertDisable: false,
            showAlertEnable: false
        }
    },
    methods:{
        async disableUser(userCode){
             try{   
                const user = this.users.find(user => user.code === userCode); 
                const newUser = {...user, active:false};
                const response = await axios.post("https://sidespe-api.herokuapp.com/users", newUser);                                           
                if(response.status === 201){
                    this.showAlertDisable = true;
                    setTimeout(() => {
                        window.location.href='/users';                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
            }        
        },
        async activeUser(userCode){
             try{   
                const user = this.users.find(user => user.code === userCode); 
                const newUser = {...user, active:true};
                const response = await axios.post("https://sidespe-api.herokuapp.com/users", newUser);                                           
                if(response.status === 201){
                    this.showAlertEnable = true;
                    setTimeout(() => {
                        window.location.href='/users';                        
                    }, 3000); 
                }
            }catch(err){
                console.log(err)
            }        
        }
    },
    async mounted(){           
            try{                               
                const response = await axios.get('https://sidespe-api.herokuapp.com/users/');   
                this.users = response.data;
            }catch(err){
                console.log(err);
            }            
    }
}
</script>

<style>

</style>
