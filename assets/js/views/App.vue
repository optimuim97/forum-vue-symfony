<template>
    <div>
        <toolbar></toolbar>
        <router-view>
            <!-- <router-link to="home" >Home</router-link>
            <router-link to="login">Login</router-link>
            <router-link to="register">Register</router-link> -->
        </router-view>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import toolbar  from '../components/partials/Toolbar'
    import appFooter from '../components/partials/AppFooter'

    export default{
        name: "App",
        components:
        {
            toolbar,
            appFooter
        }
    }
</script>

<style scoped>

</style>