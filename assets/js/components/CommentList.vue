<template>
     <v-container grid-list-xs>
        <comment v-for="comment in comments_list" :key="comment.id" :data="comment"></comment>
    </v-container>
</template>

<script>
import Comment from './Comment';

export default {
    props : ['comments_list'],
    components : {
        Comment
    },
}
</script>

