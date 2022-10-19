<template>
    <v-main>

        <div>
            <h1> Mon Profil </h1>
        </div>

        <v-card>
            <v-card-media src="src" height="200px">

            </v-card-media>
            <v-card-title primary-title>
                <div>
                    <h3 class="headline mb-0">{{user.username}}</h3>
                    <h3 class="headline mb-0">{{user.email}}</h3>
                    <!-- <h3 class="headline mb-0">{{user.username}}</h3> -->
                </div>
            </v-card-title>

            <!-- <v-card-actions>
                <v-btn flat color="primary">text</v-btn>
                <v-btn flat color="primary">text</v-btn>
            </v-card-actions> -->
        </v-card>
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