<template>
    <v-app>
        <toolbar></toolbar> 
            <router-view>
            </router-view>
            <v-btn
                v-show="hidden"
                color="primary floating-button"
                dark
                absolute
                fixed
                bottom  
                right
                fab

                to="/create"
              >
                <v-icon>mdi-plus</v-icon>
            </v-btn>
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
        },
        data() {
            return {
                hidden:false
            }
        },
        methods : {
            floatingButtonShowState (){
                return this.$route.name == 'Create' ? this.hidden = false : this.hidden = true ;
            }
        },
        updated() {
            this.floatingButtonShowState()
        },
        created(){
            this.floatingButtonShowState()
        }
    }
</script>

<style scoped>
    .page-bg{
        background-image: url('../../svg/Scenes/Scenes03.svg');
    }
    .floating-button{
        margin-bottom: 9%;
    }
</style>