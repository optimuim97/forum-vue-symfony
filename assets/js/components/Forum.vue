<template>
   <v-container fluid>
        <!-- <v-layout row wrap> -->
            <!-- <v-flex> -->
                <v-row>
                    <v-col cols="2">
                        <v-sheet rounded="lg">
                            <v-list color="transparent">
                                <v-list-item
                                    v-for="category in categories"
                                    :key="category.id"
                                link
                                >
                                <v-list-item-content>
                                    <v-list-item-title>
                                            {{ category.name }}
                                    </v-list-item-title>
                                </v-list-item-content>
                                </v-list-item>
                                    <v-divider class="my-2"></v-divider>
                                <v-list-item
                                    link
                                    color="grey lighten-4"
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>
                                        Refresh
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-sheet>
                    </v-col>

                    <v-col cols="10">
                        <v-card class="p-4" v-if="articles.length == 0">
                            <p class="text-h5 font-weight-bold text-lg-center py-11"> Pas d'articles disponibles </p>
                        </v-card>

                        <post v-else v-for="article in articles" :key="article.id"  :article='article'></post>

                        <v-divider vertical dark height="2px"></v-divider>
                    </v-col>
                </v-row>
            <!-- </v-flex>             -->
        <!-- </v-layout> -->
   </v-container>
</template>


<script>
    import Post from './Post'

    export default {
        components : {Post},
        data (){
            return {
                articles : null,
                categories : null
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
                
            },
            getCategories(){
                axios.get('/api/v1/categories').then(res=>{
                    this.categories = res.data;
                }).catch(error => {
                    console.log(error.data)
                })
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