<template>
    <div>
        <div class="table-responsive">
             <div class="row">                                                                           
                <div class="form-group col-md-3">                            
                    <label for="Selecione o curso">Selecione o curso<span class="text-danger f-16" title="Campo obrigatório">*</span></label>                                                 
                    <select v-model="courseSelect" v-on:change="filtrarDados"  name="tipo" class="form-control borda-input" >
                        <option value="">Selecione o curso...</option>
                        <option v-for="course in courses" v-bind:key="course.code" :value=course.code>{{course.name}}</option>                                                                
                    </select>
                </div>
                <div class="form-group col-md-3">
                        <label for="Data Início">Data Início</label>                                                                 
                        <input v-on:change="filtrarPorData" v-model="dateStart" type="date" class="form-control borda-input" placeholder="Selecione a data...">                                                     
                </div>                           
                <div class="form-group col-md-3">
                        <label for="Data Fim">Data Fim</label>                                                                 
                        <input v-on:change="filtrarPorData" v-model="dateEnd" type="date" class="form-control borda-input" placeholder="Selecione a data...">                                                     
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
                <tr v-for="ocurrence in ocurrenceList" v-bind:key="ocurrence.code">
                    
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

                <tr v-if="ocurrenceList.length === 0" >
                    <td colspan="3">Nenhuma ocorrência foi encontrada.</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import localUser from '../util/LOCALUSER';
export default {
    data(){
        return {
            ocurrences: [],
            ocurrenceList: [],
            courses: [],            
            courseSelect: '',
            dateStart: '',
            dateEnd: '',
            localUser: localUser
        }
    },
    methods:{
        async filtrarDados(){
            try {                
                const response = await axios.get(`https://sidespe-api.herokuapp.com/ocurrences/${this.courseSelect}/courses`);
                this.ocurrences = response.data.sort((a,b) => new Date(a.createdAt) - new Date(b.createdAt));                
                this.ocurrenceList = this.ocurrences;
                this.dateStart = '';
                this.dateEnd = '';
            } catch (err) {
                if(err.response.status = 404){
                    this.ocurrences = [];
                    this.ocurrenceList = [];
                }
            }
        },
        filtrarPorData(){
            if(this.ocurrences){                                
                if((this.dateStart && this.dateEnd) && (this.dateStart <= this.dateEnd)){                    
                    this.ocurrenceList = this.ocurrences.filter(ocurrence => ocurrence.createdAt >= this.dateStart && ocurrence.createdAt <= this.dateEnd);
                }else if(this.dateStart){
                     this.ocurrenceList = this.ocurrences.filter(ocurrence => ocurrence.createdAt >= this.dateStart);
                }else if(this.dateEnd){
                     this.ocurrenceList = this.ocurrences.filter(ocurrence => ocurrence.createdAt <= this.dateEnd);
                }else{
                     this.ocurrenceList = this.ocurrences;
                }               
            }             
        }
    },
    async mounted(){           
            try{     
                const response = await axios.get(`https://sidespe-api.herokuapp.com/courses/${this.localUser.code}/users`);   
                this.courses = response.data;                                                          
                
            }catch(err){
                console.log(err);
            }
    }
}
</script>

<style>

</style>
