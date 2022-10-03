<template>
    <v-container fluid>
        <v-card>
            <v-card-title primary-title>
                <div>
                    <h3 class="headline mb-0"> 👨🏿‍🦲 {{ comment.User.username}}</h3>
                    <div>{{ comment.comment }}</div>
                    <div>{{ comment.createdAt | moment("dddd, MMMM Do YYYY") }}</div>
                </div>
            </v-card-title>
        </v-card>            
    </v-container>
</template>

<script>
export default {
    props :[
        'comment'
    ]
}
</script>