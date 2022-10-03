<template>
    <v-card>
        <v-card-title> 
            <router-link :to="path_">
                {{ article.title }}    
            </router-link>         
        </v-card-title>

        <v-card-subtitle> 
            <span>{{ article.createdAt | moment("dddd, MMMM Do YYYY") }}</span>         
        </v-card-subtitle>

        <v-card-text v-html="article.content">
        
        </v-card-text>
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