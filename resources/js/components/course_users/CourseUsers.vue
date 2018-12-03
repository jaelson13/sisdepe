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