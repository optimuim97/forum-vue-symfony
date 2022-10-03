<template>
    <v-container>
        <h2>Login</h2>
        <v-form
            ref="form"
            @submit.prevent="login"
        >
            <v-text-field
                v-model="form.username"
                label="username"
                required
            ></v-text-field>

            <v-text-field
                v-model="form.password"
                label="password"
                type="password"
                required
            >
            
            </v-text-field>

            <v-btn type="submit" color="green">
                Connexion
            </v-btn>

            <v-btn color="blue">
                <router-link to="/register">
                    Inscription
                </router-link>
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
    export default {

        data(){
            return {
                form : {
                    username : null,
                    password: null
                }
            }
        },
        methods : {
            login (){
                User.login(this.form) 
            }
        },
        created(){
            if(User.loggIn()){
                this.$router.push({name: 'Forum' })
            }
        }
    }
</script>   