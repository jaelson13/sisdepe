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
                </tr>

                <tr v-if="ocurrences.length === 0" >
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
            courses: [],            
            courseSelect: '',
            localUser: localUser
        }
    },
    methods:{
        async filtrarDados(){
            try {
                console.log(this.courseSelect)
                const response = await axios.get(`https://sidespe-api.herokuapp.com/ocurrences/${this.courseSelect}/courses`);
                this.ocurrences = response.data.sort((a,b) => new Date(a.createdAt) - new Date(b.createdAt));;
            } catch (err) {
                if(err.response.status = 404){
                    this.ocurrences = [];
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
