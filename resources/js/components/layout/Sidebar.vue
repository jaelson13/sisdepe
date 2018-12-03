<template>    
    <div>
        <div v-show="isAdmin">
            <li>
                <a href="/users">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>Usuarios</p>
                </a>
            </li>
            <li>
                <a href="/courses">
                    <i class="fa fa-book"></i>
                    <p>Cursos</p>
                </a>
            </li>          
            <li>
                <a href="/typesofocurrences">
                    <i class="now-ui-icons shopping_tag-content"></i>
                    <p>Tipos de Ocorrências</p>
                </a>
            </li>
        </div> 
        <div v-show="isCoordinator">
            <li>
                <a href="/courses">
                    <i class="fa fa-book"></i>
                    <p>Cursos</p>
                </a>
            </li>
            <li>
                <a href="/demandas">
                    <i class="fa fa-book"></i>
                    <p>Ocorrencias</p>
                </a>
            </li> 
            <li>
                <a href="/projetos">
                    <i class="fa fa-book"></i>
                    <p>Projetos</p>
                </a>
            </li>
            <li>
                <a href="/relatorios">
                    <i class="fa fa-book"></i>
                    <p>Relatórios</p>
                </a>
            </li>
        </div>
        <div v-show="isTeacher">
            <li>
                <a href="/ocurrences">
                    <i class="fa fa-book"></i>
                    <p>Ocorrências</p>
                </a>
            </li>
             <li>
                <a href="/projects">
                    <i class="fa fa-book"></i>
                    <p>Projetos</p>
                </a>
            </li>
        </div>
    </div>
</template>

<script>
import localUser from '../util/LOCALUSER';
export default {
    data(){
        return{
            isAdmin: false,
            isCoordinator: false,
            isTeacher: false,
            localUser: localUser,            
        }
    },
    mounted(){    
        if(this.localUser.type === 'COORDINATOR'){
            this.isAdmin = false;
            this.isCoordinator = true;
            this.isTeacher = false;
        }
        if(this.localUser.type === 'ADMINISTRATOR'){
            this.isAdmin = true;
            this.isCoordinator = false;
            this.isTeacher = false;            
        }
        if(this.localUser.type === 'TEACHER'){
            this.isAdmin = false;
            this.isCoordinator = false;
            this.isTeacher = true;            
        }
    }
}
</script>

<style>

</style>
