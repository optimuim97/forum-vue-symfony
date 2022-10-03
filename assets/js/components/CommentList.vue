<template>
    <div>  
        <comment v-for="comment in comments_list" :key="comment.id" :comment="comment"></comment>
    </div>
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

