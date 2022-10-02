<template>
   <v-container fluid>
        <v-layout row wrap>
            <v-flex xs8>
                Forum
                <!-- <question  v-for="question in questions" :key="question.path" :question='question'></question> -->
            </v-flex>            
        </v-layout>
   </v-container>
</template>


<script>
    // import question from './question'

    // export default {
    //     components : {question},
    //     data (){
    //         return {
    //             questions : {}
    //         }
    //     },
    //     created(){

    //         if(User.loggIn()){
    //             axios.get('/api/question').then((result) => {
                    
    //                 if(result.status == 200){
    //                     this.questions = result.data.data
    //                 }else{
    //                     alert('error')
    //                 }
                    
    //             }).catch((err) => {
    //                 console.log(error)
    //             });
    //         }else{
    //             this.$router.push({name:'login'})
    //         }
    //     }
    // }
</script>