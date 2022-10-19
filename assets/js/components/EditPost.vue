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
                }
            }
        }, 
        components : {Editor},
        props : ['data'],
        methods : {
            upatePost (){
                axios.post('/api/v1/article/'+this.data.id,this.form).then((res) => {
                    console.log(res)
                    EventBus.$emit('afterEdit')
                    this.$toastr('success', 'Article Mise à jour', 'Super ✔️')

                }).catch((err) => {
                    console.log(err.response)
                });
            },
            cancel(){
                EventBus.$emit('afterEdit')
            },
            getHTML(){
                let html = this.$refs.toastuiEditor.invoke('getHTML');
                this.form.content = html
            }
        },
        created(){
            this.form = this.data
        }
    }
</script>
