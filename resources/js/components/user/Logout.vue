<template>
    <div>
        <a v-on:click="logout" class="dropdown-item" href="">Sair</a>
    </div>
</template>

<script>
export default {
    data(){
        return{
            
        }
    },
    methods: {
        logout(){           
            document.cookie = "isLogging=;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
            window.location.href='/';                        
             
        }

    }
}
</script>