<template>
        <v-card>
            <v-container fluid>
                
                <v-card-title>
                        <div class="headline"> 
                            {{ data.title }}
                        </div>
                        <!-- <span class="grey--text" small>{{ data.author.username }} said {{ data.createdAt }}</span> -->
                        <v-spacer></v-spacer>
                        <div d-flex>
                            <v-btn color="teal" class="ml-5"> 5 Replies </v-btn>
                        </div>
                </v-card-title>

                <v-card-text v-html="data.content"></v-card-text>
                
            </v-container>

            <v-card-actions v-if="own()">     
                <v-btn icon>
                    <v-icon color="orange" @click="edit">mdi-pencil</v-icon>
                </v-btn>

                <v-btn icon>
                    <v-icon color="red" @click="deleteQuestion">mdi-delete</v-icon>
                </v-btn>
            </v-card-actions>

        </v-card>
</template>

<script>
    export default {
        props : ['data'],
        methods : {
            edit(){
                EventBus.$emit('startEditing')
            },  
            deleteQuestion(){
                
                axios.delete(`/api/v1/article/${this.data.id}`).then((result) => {
                    console.log(result)

                    this.$router.push('/forum')
                }).catch((err) => {
                    console.log(err)
                });
            },
            own(){
                // return User.own(this.data.author.id)
            }
        },
        created(){
            this.own()
        }
    }
</script>