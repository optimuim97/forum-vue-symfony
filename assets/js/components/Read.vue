<template>
    <div>
        <div v-if="editing">
            <edit-question :question_data="article"></edit-question>
        </div>

        <div v-if="!editing">
            <show-post :data="article"></show-post>
        </div>
    </div>
</template>

<script>
    import ShowPost from './ShowPost.vue'
    import EditPost from './EditPost.vue'

    export default {
        components : {ShowPost, EditPost},
        data(){
            return {
                article : null,
                editing : false
            }
        },
        created(){
            this.listen(),
            this.getQuestion()
        },
        methods : {
            listen (){
                EventBus.$on('startEditing', () => {
                    this.editing = true
                })
            },
            getQuestion (){
                const article_id = this.$route.params.id

                 axios.get("/api/v1/article/" + article_id).then((result) => {
                    this.article  = result.data.data
                }).catch((err) => {
                    console.log(err)
                });
            }
        }
    }
</script>