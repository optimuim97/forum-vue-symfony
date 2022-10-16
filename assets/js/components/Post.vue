<template>
    <v-card>
        <v-card-title class="text-h5 font-weight-bold"> 
            <router-link :to="path_">
                {{ article.title }}    
            </router-link>         
        </v-card-title>

        <v-card-subtitle> 
            <span>{{ article.createdAt | moment("dddd, MMMM Do YYYY") }}</span>   

                 
            <v-card-title class="text-h5 font-weight-bold" style="font-size:20px;" v-html="article.content">
            
            </v-card-title>

            <div class="d-flex justify-content-center">
                <v-list-item-title class="ml-3"> Published by {{article.author.username}}</v-list-item-title>
            </div> 
        </v-card-subtitle>
            
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