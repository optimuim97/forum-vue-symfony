<template>
     <v-container grid-list-xs>

        <h1> Modifier une Article </h1>

        <v-form @submit.prevent="upatePost">
            <v-text-field
                name="title"
                label="Titre" 
                id="title"
                v-model="form.title"
            ></v-text-field>
        

            <editor 
                name="body"
                label="Description"
                id="body"
                ref="toastuiEditor"
                @change="getHTML()"
                :initialValue="form.content"
                getHTML
            />
            
            <v-btn  icon color="green" type="submit">
                <v-icon>mdi-content-save</v-icon>
            </v-btn>

            <v-btn  icon color="red" @click="cancel">
                <v-icon>mdi-cancel</v-icon>
            </v-btn>
            
        </v-form>
    
   </v-container>
</template>

<script>
    import { Editor } from '@toast-ui/vue-editor';

    export default {
        data(){
            return {
                form : {
                    title : null,
                    content : null
                },
                categories : null
            }
        }, 
        components : {Editor},
        props : ['question_data'],
        methods : {
            upatePost (){
                console.log("form datas =>")
                console.log(this.form)
                axios.put('/api/v1/article/'+this.question_data.id,this.form).then((res) => {
                    
                    console.log("check result")

                    console.log(res)
                }).catch((err) => {
                    console.log(error.response)
                });
            },
            cancel(){
                console.log(this.form);
                url = this.question.url
                console.log(url)
            },
            getHTML(){
                let html = this.$refs.toastuiEditor.invoke('getHTML');
                this.form.body = html
            }
        },
        created(){
            this.form = this.question_data
        }
    }
</script>
