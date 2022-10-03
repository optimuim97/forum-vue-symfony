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
                    <v-icon class="mr-1">
                        mdi-heart
                    </v-icon>
                    
                    <span class="subheading mr-2">{{ data.comments.length }}</span>
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
                            <v-icon color="red" @click="deleteQuestion">mdi-delete</v-icon>
                        </v-btn>
                    </div>
                
                </v-row>

               
                </v-list-item>
            </v-card-actions>
        </v-card>

        <v-spacer></v-spacer>

        <v-content class="mt-4">     
            <v-form>
            <v-container>
                <v-row>
                
                    <v-col cols="12">
                        <v-text-field
                            v-model="message"
                            filled
                            clear-icon="mdi-close-circle"
                            clearable
                            label="Add Comment"
                            type="text"

                            @click.prevent="addComment"
                        >
                        </v-text-field>
                    </v-col>

                </v-row>
            </v-container>
            </v-form>
        </v-content>

        <v-divider></v-divider>


        <comment-list :comments_list="data.comments"></comment-list>
        
        
    </v-container>
</template>


<script>
    import commentList from "./CommentList";

    export default {
        props : ['data'],
        components : {
            commentList
        },
        methods : {
            edit(){
                EventBus.$emit('startEditing')
            },  
            deleteQuestion(){
                
                axios.delete(`/api/v1/article/${this.data.id}`).then((result) => {
                    this.$router.push('/forum')
                }).catch((err) => {
                    console.log(err)
                });
            },
            own(){
                return this.data.author.username == localStorage.getItem('user')
            },
            addComment(){

            }
        },
        data() {
            return {
                message : null
            }
        },
        created(){

            console.log("<<<<own>>>>")
            console.log(this.own())

            this.own()
        }
    }
</script>