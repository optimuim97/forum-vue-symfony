<template>
    <v-container>
        <v-layout align-center justify-center>

            <div class="pa-md-4 mx-lg-auto" width="400px">
                <div class="my-7">
                    <v-icon
                        large
                        centered
                        right
                    >                    
                        Se Connecter   
                    </v-icon>
                </div>


                <v-form
                    ref="form"
                    @submit.prevent="login"
                >
                    <v-text-field
                        v-model="form.username"
                        label="Nom d'utilisateur"
                        required
                    ></v-text-field>

                    <v-text-field
                        v-model="form.password"
                        label="Mot de passe"
                        type="password"
                        required
                    >
                    
                    </v-text-field>


                   <div class="d-flex justify-space-around my-6">
                        <v-btn
                            type="submit"
                            color="primary"
                            class="mr-2"
                        >
                            Connexion
                        </v-btn>

                        <v-btn color="secondary" to="/register">
                            Inscription
                        </v-btn>
                    </div>
                    

                </v-form>

            </div>
        
        </v-layout>
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
            this.$loading(false)
            
            if(User.loggIn()){
                this.$router.push({name: 'Forum' })
            }
        }
    }
</script>   