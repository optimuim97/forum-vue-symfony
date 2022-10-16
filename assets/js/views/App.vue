<template>
    <v-app>
        <toolbar></toolbar> 
             <router-view>
            </router-view>
        <app-footer></app-footer> 
    </v-app>
</template>

<script>
    import toolbar  from '../components/partials/Toolbar'
    import appFooter from '../components/partials/AppFooter'
    import login from '../components/Login'

    export default {
        name: "App",
        components:
        {
            toolbar,
            appFooter,
            login
        }
    }
</script>

<style scoped>

</style>