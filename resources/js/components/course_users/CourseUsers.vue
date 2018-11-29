<template>
    <div>
        <div class="table-responsive">
            <table class="table table-striped" style="margin-bottom: 60px;">
                <thead class="text-primary">
                <tr>
                    <th class="td">
                        Nome
                    </th>
                    <th class="td">
                        Email
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" v-bind:key="user.code">                    
                    <td>
                        {{user.name}}
                    </td>
                    <td>
                        {{user.email}}
                    </td>
                    <td class="float-right mr-3">
                        <a href="#" class="dropdown " data-toggle="dropdown">
                            <i class="material-icons">
                                more_horiz
                            </i>
                        </a>
                        <ul class="dropdown-menu" style="padding-left: 10px; " role="menu">
                            <li><a :href="`/courses/${codecourse}/edit_grade/${users.code}`">Editar</a></li>                            
                            <li><a href="#">Desativar Usuário</a></li>
                        </ul>

                    </td>
                </tr>

                <tr v-if="users.length === 0" >
                    <td colspan="5">Nenhum usuário foi encontrado.</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: ['coursecode'],
    data(){
        return {
            users: [],
            codecourse: null
        }
    },
    methods:{
        
    },
    async mounted(){
        try{
            this.codecourse = JSON.parse(this.coursecode);
            const response = await axios.get(`https://sidespe-api.herokuapp.com/courses/${this.codecourse}`);       
            this.users = response.data.users;                                                    
        }catch(err){
            console.log(err)
        }      
    }
}
</script>