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
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            isAdmin: false,
            isCoordinator: false,
            isTeacher: false
        }
    },
    mounted(){
        const user = JSON.parse(localStorage.getItem('user'));
        if(user.type === 'COORDINATOR'){
            this.isAdmin = false;
            this.isCoordinator = true;
            this.isTeacher = false;
        }
        if(user.type === 'ADMIN'){
            this.isAdmin = true;
            this.isCoordinator = false;
            this.isTeacher = false;
        }
        if(user.type === 'TEACHER'){
            this.isAdmin = false;
            this.isCoordinator = false;
            this.isTeacher = true;
        }
    }
}
</script>

<style>

</style>
