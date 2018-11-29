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
                        Descrição
                    </th>
                    <th class="td">
                        Turmas
                    </th>
                    <th class="td">
                        Professores
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="course in courses" v-bind:key="course.code">
                    
                    <td>
                        {{course.name}}
                    </td>
                    <td>
                        {{course.description}}
                    </td>
                    <td>
                        <a :href="'/courses/'+course.code+'/grades'">Ver Turmas</a>
                    </td>
                    <td>
                        <a :href="'/courses/'+course.code+'/users'">Ver Professores</a>
                    </td>
                    <td class="float-right mr-3">
                        <a href="#" class="dropdown " data-toggle="dropdown">
                            <i class="material-icons">
                                more_horiz
                            </i>
                        </a>
                        <ul class="dropdown-menu" style="padding-left: 10px; " role="menu">
                            <li><a :href="'/edit_course/'+course.code">Editar</a></li>                            
                            <li><a href="#">Desativar Usuário</a></li>
                        </ul>

                    </td>
                </tr>

                <tr v-if="courses.length === 0" >
                    <td colspan="5">Nenhum tipo de ocorrência foi encontrada.</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            courses: [],
        }
    },
    methods:{
        
    },
    async mounted(){
        try{                             
            const response = await axios.get("https://sidespe-api.herokuapp.com/courses/");       
            this.courses = response.data;                                                    
        }catch(err){
            console.log(err)
        }      
    }
}
</script>

<style>

</style>
