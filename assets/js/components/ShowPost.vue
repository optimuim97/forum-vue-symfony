<template>
    <v-container fluid>
        <v-card>
            <v-card-title>
            <v-icon
                large
                left
            >
                {{data.title}}
            </v-icon>
            <span class="text-h6 font-weight-light"></span>
            </v-card-title>

            <v-card-text class="text-h5 font-weight-bold" v-html="data.content">
            </v-card-text>

                  <v-card-actions v-if="own()">     
              
            </v-card-actions>

            <v-card-actions>
                <v-list-item class="grow">
                    <v-list-item-avatar color="grey darken-3">
                        <v-img
                            class="elevation-6"
                            alt=""
                            src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                        ></v-img>
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>{{data.author.username}}</v-list-item-title>
                    </v-list-item-content>

                <v-row
                        align="center"
                        justify="end"
                    >
                    <v-icon class="mr-1" @click="like">
                        mdi-heart
                    </v-icon>
                    
                    <span class="subheading mr-2">
                        {{ data.likes.length }}
                    </span>
                    
                    <span class="mr-1">·</span>
                    <v-icon class="mr-1">
                        mdi-message-text-outline
                    </v-icon>
                    <span class="subheading">{{ data.comments.length }}</span>

                    <div v-if="own()">
                        <v-btn icon>
                            <v-icon color="orange" @click="edit">mdi-pencil</v-icon>
                        </v-btn>

                        <v-btn icon>
                            <v-icon color="red" @click="deleteArticle">mdi-delete</v-icon>
                        </v-btn>
                    </div>
                
                </v-row>

               
                </v-list-item>
            </v-card-actions>


            <div>
                <comment-list :comments_list="data.comments"></comment-list>
            </div>

        </v-card>

        <v-spacer></v-spacer>

        <v-content class="mt-4">     
            <v-form  @submit.prevent="addComment">
            <v-container>
                <v-row>
                    <v-col cols="8">
                        <v-text-field
                            v-model="form.comment"
                            filled
                            clear-icon="mdi-close-circle"
                            clearable
                            label="Add Comment"
                            type="text"
                        >
                        </v-text-field>

                        
                    </v-col>

                    <v-col cols="4">
                        <v-btn class="py-3" color="success" type="submit"> Comment </v-btn>
                    </v-col>

                    
                </v-row>
            </v-container>
            </v-form>

            <v-divider></v-divider>
        </v-content>  

    </v-container>
</template>


<script>
    import CommentList from "./CommentList.vue";

    export default {
        props : ['data'],
        components : {
            CommentList
        },
        data() {
            return {
                form:{
                    comment: null,
                    id : null
                },

            }
        },  
        methods : {
            edit(){
                EventBus.$emit('startEditing')
            },  
            deleteArticle(){
                axios.delete(`/api/v1/article/${this.data.id}`).then((result) => {

                    console.log(">>>>>>>>>>>>>>")
                    console.log(result)

                    this.$toastr('info', 'Article deleted ❌!', 'Error')

                    this.$router.push('/forum')

                }).catch((err) => {
                    console.log(err)
                });
            },
            own(){
                return this.data.author.username == localStorage.getItem('user')
            },
            addComment(){
                this.form.id = this.data.id

                axios.post('/api/v1/comment', this.form).then((result) => {

                    this.data.comments.push(result.data.data)
                    this.form = {}

                }).catch((err) => {
                    console.log(err)
                });
            },
            like(){
                axios.post(`/api/v1/like/${this.data.id}`).then((result) => {
                    console.log(result)
                    this.data.likes.push(result.data.like)
                    
                }).catch((err) => {
                    console.log(err)
                });
            }
        },
        created(){
            this.own()
        }
    }
</script>