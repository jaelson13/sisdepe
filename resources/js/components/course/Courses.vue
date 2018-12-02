<template>
<div>
<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            <h5 class="title pt-2">Cursos</h5>
        </div>

        <div class="col-md-8 pr-5">
           
            <a v-if="localUser.type != 'COORDINATOR'" class="btn btn-success float-right" href="/new_course">Novo Curso</a> 
            
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 m-auto">    
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
                    <td v-if="localUser.type != 'COORDINATOR'" class="float-right mr-3">
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
    </div>
</div>        
    </div>
</template>

<script>
import localUser from '../util/LOCALUSER';
export default {
    data(){
        return {
            courses: [],
            localUser: localUser            
        }
    },
    methods:{
        
    },
    async mounted(){
        try{                                        
            const response = await axios.get("https://sidespe-api.herokuapp.com/courses/");                                                                      
            if(this.localUser.type === 'COORDINATOR'){                
                response.data.forEach(course => {
                    course.users.forEach(user => {
                        if(user.code == this.localUser.code){
                            this.courses.push(course)
                        }
                    })
                })                               
            }else{
                this.courses = response.data; 
            }
        }catch(err){
            console.log(err)
        }      
    }
}
</script>

<style>

</style>
