<template>
    <div>
        <div class="table-responsive">
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
                    <td colspan="5">Nenhuma ocorrência foi encontrada.</td>
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
            localUser: localUser

        }
    },
    methods:{
        
    },
    computed:{
       
    },
    async mounted(){           
            try{                               
                const response = await axios.get(`https://sidespe-api.herokuapp.com/ocurrences/teachers/${this.localUser.code}`);   
                this.ocurrences = response.data;     
                console.log(this.ocurrences)           
            }catch(err){
                console.log(err);
            }
    }
}
</script>

<style>

</style>
