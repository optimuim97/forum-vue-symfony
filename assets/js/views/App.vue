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

    export default{
        name: "App",
        components:
        {
            toolbar,
            appFooter
        },

    }
</script>

<style scoped>

</style>