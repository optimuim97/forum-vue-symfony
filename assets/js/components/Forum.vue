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
        created(){

            setTimeout(() => {
                if(User.loggIn()){
                    axios.get('/api/v1/articles').then((result) => {
                            this.articles = result.data.data

                            console.log(this.articles)
                    
                    }).catch((err) => {
                        console.log(error)
                });
            }else{
                this.$router.push({name:'login'})
            }
            }, 5000);

          
        }
    }
</script>