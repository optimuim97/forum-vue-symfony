<template>
   <v-container grid-list-xs>

        <h1> Ajouter une Question </h1>

        <v-form @submit.prevent="addArticle">
            <v-text-field
                name="title"
                label="Titre"
                id="title"
                v-model="form.title"
            ></v-text-field>  

            <editor 
                name="content"
                label="Description"
                id="content"
                ref="toastuiEditor"
                @change="getHTML()"
                getHTML
            />

            <div>
                <v-btn color="success" type="submit">Ajouter</v-btn>
            </div>
        </v-form>
    
   </v-container>
</template>

<script>
    import '@toast-ui/editor/dist/toastui-editor.css';
    import { Editor } from '@toast-ui/vue-editor';

    export default {
        components : {
            editor: Editor
        },
        data(){
            return {
                form : {   
                    title :null, 
                    content : null
                },  
                errors : null
            }
        },
        methods : {
            addArticle (){
                
                axios.post('/api/v1/article',
                     this.form,
                     {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                     }
                ).then((result) => {
                    console.log(result)
                    this.$router.push({path : `/api/v1/articles` })
                    // this.$router.push({path : `${result.data.id}` })
                }).catch((err) => {
                    
                    console.log(err)
                    
                    // this.errors = err.data
                });
            },
            getHTML() {
                let html = this.$refs.toastuiEditor.invoke('getHTML');
                this.form.content = html
            }   
        },
        created(){
            
        },
      
    }
</script>