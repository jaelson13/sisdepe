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
                        Período
                    </th>
                    <th class="td">
                        Turno
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="grade in grades" v-bind:key="grade.code">
                    
                    <td>
                        {{grade.name}}
                    </td>
                    <td>
                        {{grade.period}}
                    </td>
                    <td>
                        {{grade.shift}}
                    </td>
                    <td class="float-right mr-3">
                        <a href="#" class="dropdown " data-toggle="dropdown">
                            <i class="material-icons">
                                more_horiz
                            </i>
                        </a>
                        <ul class="dropdown-menu" style="padding-left: 10px; " role="menu">
                            <li><a :href="`/courses/${codecourse}/edit_grade/${grade.code}`">Editar</a></li>                            
                            <li><a href="#">Desativar Usuário</a></li>
                        </ul>

                    </td>
                </tr>

                <tr v-if="grades.length === 0" >
                    <td colspan="5">Nenhum turma foi encontrada.</td>
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
            grades: [],
            codecourse: null
        }
    },
    methods:{
        
    },
    async mounted(){
        try{
            this.codecourse = JSON.parse(this.coursecode);
            const response = await axios.get(`https://sidespe-api.herokuapp.com/courses/${this.codecourse}`);       
            this.grades = response.data.grades;                                                    
        }catch(err){
            console.log(err)
        }      
    }
}
</script>

<style>

</style>
