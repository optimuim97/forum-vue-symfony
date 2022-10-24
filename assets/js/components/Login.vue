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

    import AppStorage from '../utils/AppStorage';
    import Token from '../utils/Token';

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
                // User.login(this.form) 

                var username_ = this.form.username;

                console.log("Sended datas ...")

                axios
                    .post("api/login_check", this.form)
                    .then((res) => {

                        console.log("login response...")
                        const access_token = res.data.token;
                        const username = username_;
                        console.log("res.data ...")
                        console.log(res)
                        console.log("response after login ...")
                        console.log(">>>>>UserName<<<<", ">>>>>Access Token<<<<<")
                        console.log(username_, access_token)
                        
                        if (Token.isValid(access_token)) {
                            AppStorage.storeData(username, access_token);
                            EventBus.$emit('login')       
                            // console.log(this.loggIn())  
                            
                            window.axios = require('axios');
                            const JWTToken = `Bearer ${localStorage.getItem('token')}`

                            window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
                            window.axios.defaults.headers.common['Authorization'] = JWTToken;

                            this.$toastr('success', `Bienvenue ${username} 😉!`, 'Super ☑️')

                        } 

                    })
                    .catch((error) => {

                        console.log(error)

                        this.$toastr('error', 'Email ou mot de passe incorrect ...', 'OOps 😑 ❌')
                    });
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