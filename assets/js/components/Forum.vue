<template>
   <v-container fluid>
        <v-layout row wrap>
            <v-flex>
                <div>
                    <post v-for="article in articles" :key="article.createdAt"  :article='article'></post>
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
                articles : {}
            }
        },
        async serverPrefetch() {
            this.data = await getArticle()
        },
        methods: {
            getArticles(){

                setTimeout(() => {

                    const JWTToken = `Bearer ${localStorage.getItem('token')}`
                    
                    if(!User.loggIn()){
                        this.$router.push({name:'login'});
                    }
               
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
                        console.log(error)
                    });

                }, 5000);
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