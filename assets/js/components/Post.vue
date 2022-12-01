<template>
    <v-card :href="`#/${path_}`">
        <v-card-title class="text-h5 font-weight-bold"> 
            <router-link :to="path_">
                {{ article.title }}    
            </router-link>         
        </v-card-title>

        <v-card-subtitle> 
            <span>{{ article.createdAt | moment("from", "now") }}</span>   

            <v-card-title class="text-h5 font-weight-bold" style="font-size:20px;" v-html="article.content">
            
            </v-card-title>

            <div class="d-flex justify-content-center">
                <v-list-item-title class="ml-3"> Publié par <span class="text-h6">  {{ article.author.username }} </span> </v-list-item-title>
            </div> 
        </v-card-subtitle>

        <v-card-actions>
                <v-row
                    align="center"
                    class="ml-4 mb-2"
                    justify="start"
                >
                    <v-icon class="mr-1">
                        mdi-heart
                    </v-icon>
                    
                    <span class="subheading mr-2">
                        {{ article.likes.length }}
                    </span>
                    
                    <span class="mr-1">·</span>
                    <v-icon class="mr-1">
                        mdi-message-text-outline
                    </v-icon>
                    <span class="subheading">
                        {{ article.comments.length }}
                    </span>
                </v-row>
        </v-card-actions>   
    </v-card>
</template>

<script>

    export default {
        props:['article'],
        data(){
            return {
                path_ : `api/v1/article/${this.article.id}`
            }
        }
    }
</script>