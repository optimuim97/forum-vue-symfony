<template>
    <div>
        <div v-if="editing">
            <edit-post :data="article"></edit-post>
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
            this.listen()
        },
        mounted() {
            this.getArticle()
        },
        methods : {
            listen (){
                EventBus.$on('startEditing', () => {
                    this.editing = true
                }),
                EventBus.$on('afterEdit', () => {
                    this.editing = false
                })

            },
            getArticle (){

        
                const article_id = this.$route.params.id

                const JWTToken = `Bearer ${localStorage.getItem('token')}`
                
                if(!User.loggIn()){
                    this.$router.push({name:'login'});
                }

                this.$loading(true)
               
                axios.get("/api/v1/article/" + article_id,
                {
                    headers: {
                        Authorization: JWTToken
                    }
                }
                ).then((result) => {
                    this.article  = result.data.data
                }).catch((err) => {
                    console.log(err)
                }).finally(()=>{
                    this.$loading(false)
                });

           

            }
        }
    }
</script>