<template>
    <v-main>
        <v-layout class="align-center justify-center">
            <div class="mb-5">
                <h1 class="my-10"> Mon Profil </h1>
                <v-card>
                    <v-card-media src="src" class="d-flex justify-center py-5" height="200px" width="200px">
                        <img width="200px" src="https://cdn-icons-png.flaticon.com/512/1246/1246351.png?w=1060&t=st=1666573923~exp=1666574523~hmac=7246969138c338aab7a5f420e15bbfe26ceba08651e162bcee3d14c27a2b8369" alt="avatar">
                    </v-card-media>
            
                    <div class="d-flex flex-column align-start mx-10 mb-10">
                        
                        <div>
                            <h3 class="headline">Informations Personnelles</h3>
                        </div>
                
                        <v-card-content>
                            <div class="pb-10 fields">
                                    <v-text-field
                                        name="name"
                                        label="Nom d'Utilisteur"
                                        id="id"
                                        class="fields"
                                        v-model="user.username"
                                    ></v-text-field>
                                
                                    <v-text-field
                                        name="name"
                                        label="Email"
                                        id="id"
                                        class="fields"
                                        v-model="user.email"
                                    ></v-text-field>
                                
                                    <v-text-field
                                        name="name"
                                        label="Email"
                                        id="id"
                                        class="fields"      
                                        v-model="user.phoneNumber"
                                    ></v-text-field>
                                
                            </div> 
                        </v-card-content>
                    </div>

                    

                    <!-- <v-card-actions>
                        <v-btn flat color="primary">text</v-btn>
                        <v-btn flat color="primary">text</v-btn>
                    </v-card-actions> -->
                </v-card>
            </div>
        </v-layout>
    </v-main>
</template>

<script>
    export default {

        data(){
            return {
                user : null
            }
        },
        methods: {
            getUser(){
                axios.get('/api/v1/user_data').then((res)=>{
                    console.log(res.data)
                    this.user = res.data.data
                }).cacth((err)=>{
                    console.log(err.data)
                }).finally();
            }
        },
        created(){
            this.getUser()
        }
    }
</script>

<style scoped>
    .fields{
       width: 18rem; 
    }
</style>