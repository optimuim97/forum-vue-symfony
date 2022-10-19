<template>
   <v-container fluid>
        <v-layout row wrap>
            <v-flex>
                <div>
                    <v-card class="p-4" v-if="articles.length == 0">
                        <p class="text-h5 font-weight-bold text-lg-center py-11"> Pas d'articles disponibles </p>
                    </v-card>

                    <post v-else v-for="article in articles" :key="article.id"  :article='article'></post>
                </div>
            </v-flex>            
        </v-layout>
   </v-container>
</template>


<script>
    import Post from './Post'

    export default {
        components : {Post},
        data (){
            return {
                articles : null
            }
        },
        async serverPrefetch() {
            this.data = await getArticle()
        },
        methods: {
            getArticles(){

                    const JWTToken = `Bearer ${localStorage.getItem('token')}`
                    
                    if(!User.loggIn()){
                        this.$router.push({name:'login'});
                    }
               
                    this.$loading(true)

                    axios.get('/api/v1/articles', 
                    {
                        headers: {
                            Authorization: JWTToken
                        }
                    }
                    ).then((result) => {
                        this.articles = result.data.data
                        console.log(this.articles)
                    }
                    ).catch((err) => {

                        console.log(err.response.data)

                        if(err.response.data != undefined){
                            if(err.response.data.code == 401){
                                console.log('>>>>>>>Before logout')
                                EventBus.$emit('logout')
                            }
                        }
                    }).finally(()=>{
                        this.$loading(false)
                    });
                
            }
        },
        created(){            
            if(this.getArticles()){
                async () => {
                    this.data = await getArticles()
                } 
            }
        }
    }
</script>