<template>
    <div>
        <div class="table-responsive">
            <div class="row">                                                                           
                <div class="form-group col-md-3">                            
                    <label for="Selecione o curso">Selecione o curso<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                    <select v-model="courseSelect" v-on:change="filtrarDados"  name="tipo" class="form-control borda-input" >
                        <option value="">Selecione o curso...</option>
                        <option v-for="course in coursesUser" v-bind:key="course.code" :value=course.code>{{course.name}}</option>                                                                
                    </select>
               </div>
            </div>
            <table class="table table-striped" style="margin-bottom: 60px;">
                <thead class="text-primary">
                <tr>
                    <th class="td">
                        Descrição
                    </th>
                    <th>
                        Tipo
                    </th>
                    <th>
                        Data
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="ocurrence in ocurrences" v-bind:key="ocurrence.code">
                    
                    <td>
                        {{ocurrence.description}}
                    </td>
                    <td>
                        {{ocurrence.type.name}}
                    </td>
                    <td>
                        {{ocurrence.createdAt.split('-').reverse().join('-')}}
                    </td>

                    <td class="float-right mr-3">
                        <a href="#" class="dropdown " data-toggle="dropdown">
                            <i class="material-icons">
                                more_horiz
                            </i>
                        </a>
                        <ul class="dropdown-menu" style="padding-left: 10px; " role="menu">
                            <li><a :href="'/edit_ocurrence/'+ocurrence.code">Editar</a></li>                            
                            <li><a href="#">Desativar Usuário</a></li>
                        </ul>

                    </td>
                </tr>

                <tr v-if="ocurrences.length === 0" >
                    <td colspan="5">Nenhuma ocorrência foi encontrada.</td>
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
            ocurrences: [],
            courses: [],
            coursesUser: [],
            courseSelect: ''
        }
    },
    methods:{
        async filtrarDados(){
            try {
                console.log(this.courseSelect)
                const response = await axios.get('https://sidespe-api.herokuapp.com/ocurrence/1/course');
                this.ocurrences = response.data.sort((a,b) => new Date(a.createdAt) - new Date(b.createdAt));;
            } catch (error) {
                
            }
        }
    },
    async mounted(){           
            try{            
                const localUser = JSON.parse(localStorage.getItem('user'));                   
                const response = await axios.get('https://sidespe-api.herokuapp.com/courses');   
                this.courses = [{
    "code":1,
    "name": "ADS",
    "description": "Análise e Desenvolvimento",
    "grades": [
        {
            "name": " TURMA F106",
            "period": "6",
            "shift": "DAY_SHIFT"
        },
        {
            "name": " TURMA F105",
            "period": "5",
            "shift": "NIGHT_SHIFT"
        }
    ],
    "users": [
        {
            "code": 2
        },
        {
            "code": 1
        }
    ]
},{
    "code":2,
    "name": "ADS",
    "description": "Análise e Desenvolvimento",
    "grades": [
        {
            "name": " TURMA F106",
            "period": "6",
            "shift": "DAY_SHIFT"
        },
        {
            "name": " TURMA F105",
            "period": "5",
            "shift": "NIGHT_SHIFT"
        }
    ],
    "users": [
        {
            "code": 1
        },
        {
            "code": 4
        }
    ]
},{
    "code":4,
    "name": "dsfdsdADS",
    "description": "Análise e Desenvolvimento",
    "grades": [
        {
            "name": " TURMA F106",
            "period": "6",
            "shift": "DAY_SHIFT"
        },
        {
            "name": " TURMA F105",
            "period": "5",
            "shift": "NIGHT_SHIFT"
        }
    ],
    "users": [
        {
            "code": 5
        },
        {
            "code": 4
        }
    ]
},{
    "code":7,
    "name": "hyhyjyjyADS",
    "description": "Análise e Desenvolvimento",
    "grades": [
        {
            "name": " TURMA F106",
            "period": "6",
            "shift": "DAY_SHIFT"
        },
        {
            "name": " TURMA F105",
            "period": "5",
            "shift": "NIGHT_SHIFT"
        }
    ],
    "users": [
        {
            "code": 1
        },
        {
            "code": 4
        }
    ]
}];                
                this.courses.forEach(course => {
                    course.users.forEach(user => {
                        if(user.code == localUser.code){                        
                            this.coursesUser.push(course)                  
                        }
                    })
                });
            }catch(err){
                console.log(err);
            }
    }
}
</script>

<style>

</style>
