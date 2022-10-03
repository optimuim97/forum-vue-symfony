<template>
    <v-container>

        <h1>Sign Up</h1>

        <v-form
            ref="form"
            @submit.prevent="register"
        >
            <v-text-field
                v-model="form.username"
                label="Username"
                required
            ></v-text-field>
            <span class="red--text" v-if="errors">
                {{ errors.username[0] ? errors.username[0] : "" }}
            </span>

            <v-text-field
                v-model="form.email"
                label="E-mail"
                type="email"
                required
            ></v-text-field>

            <span class="red--text" v-if="errors">
                {{ errors.name ? errors.name[0] : "" }}
            </span>

            <v-text-field
                v-model="form.password"
                label="Password"
                type="password"
                required
            ></v-text-field>

            <span class="red--text" v-if="errors">
                {{ errors.password ? errors.password[0] : "" }}
            </span>
            
            <v-btn
                type="submit"
                color="green"
            >
                Register
            </v-btn>

            <v-btn color="blue">
                <router-link to="/login">
                    Login
                </router-link>
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data(){
        return {
            form : {
                name : null,
                email : null,
                password : null
            },
            errors : null
        }
    },
    methods: {
        register(){
            console.log(this.form)
            axios.post('/api/register', this.form)
            .then((res) => {

                console.log('>>>>>')
                console.log(res)
                // User.responseAfterLogin(res)
                this.$router.push( { name : 'Login' })

                // if(User.loggIn()){
                // }else{
                //     console.log('Une erreur est survenue ...')
                // }
                
            })
            .catch( (error) => {

                console.log(error)
                // this.errors = error.response.data.errors 
            });
        }
    }
}
</script>