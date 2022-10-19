<template>
   <v-container grid-list-xs>

        <h1> Ajouter un Article </h1>

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

            <div class="btn-success">
                <v-btn color="primary" type="submit">Ajouter</v-btn>
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
                    this.$router.push({path : `/forum` })

                    this.$toastr('success', 'Article ajouté', 'Super ✔️')

                }).catch((err) => {

                    console.log(err.response)

                    this.$toastr('error', 'Une erreur est survenue ❌!', 'OOps 😑')

                });
            },
            getHTML() {
                let html = this.$refs.toastuiEditor.invoke('getHTML');
                this.form.content = html
            }   
        }
    }
</script>

<style scoped>
    .btn-success{
        margin-top : 20px;
    }
</style>