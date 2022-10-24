<template>
    <v-container>

        <v-layout align-center justify-center>
            <div class="pa-md-4 mx-lg-auto" width="400px">

                <div class="my-7">
                    <v-icon
                        large
                        centered
                        right
                    >                    
                        Créer mon Compte  
                    </v-icon>
                </div>

                <v-form
                    ref="form"
                    @submit.prevent="register"
                >
                    <v-text-field
                        v-model="form.username"
                        label="Nom d'Utilisteur"
                        required
                    ></v-text-field>

                    <span class="red--text" v-if="errors">
                        {{ errors[0] ? errors[0] : "" }}
                    </span>

                    <!-- <v-row> -->
                    <div class="d-flex flex-row">
                        <div class="dial_code mt-3"> 
                            <vue-country-code
                                @onSelect="onSelect"
                                :preferredCountries="['ci', 'bf', 'fr']">
                            </vue-country-code>
                        </div>

                        <v-text-field
                            class="ml-2"
                            v-model="form.phone_number"
                            type="tel"
                            label="Numéro de Téléphone"
                            required
                        ></v-text-field>
                    </div>

                    <!-- </v-row> -->

                    <v-text-field
                        v-model="form.email"
                        label="E-mail"
                        type="email"
                        required
                    ></v-text-field>

                    <span class="red--text" v-if="errors">
                        {{ errors[1] ? errors[1] : "" }}
                    </span>

                    <v-text-field
                        v-model="form.password"
                        label="Mot de Passe"
                        type="password"
                        required
                    ></v-text-field>

                    <span class="red--text" v-if="errors">
                        {{ errors[2] ? errors[2] : "" }}
                    </span>
                    
                    <div class="d-flex justify-space-around my-6">
                        <v-btn
                            type="submit"
                            color="primary"
                        >
                            Inscription
                        </v-btn>

                        <v-btn color="secondary" to="/login">
                            Connexion
                        </v-btn>
                    </div>
                    
                </v-form>
            </div>
          </v-layout>
    </v-container>
</template>

<script>
export default {
    data(){
        return {
            form : {
                name : null,
                email : null,
                password : null,
                dial_code : null
            },
            errors : null
        }
    },
    methods: {
        register(){
            console.log(this.form)
            axios.post('/api/register',this.form)
            .then((res) => {
                this.$toastr('info', 'Création de votre compte a été éffectué', 'Super ✔️')
                this.$router.push({path :`/login` })
            })
            .catch( (error) => {

                console.log(error.response.data.errors)
                console.log(typeof(error.response.data.errors))

                var str = error.response.data.errors
                str = str.replace("[", "")
                str = str.replace("]", "")
                str = str.replace('"\"', "")
                str = str.replace('vide"', "vide")
                str = str.replace('vide"', "vide")
                str = str.replace('vide"', "vide")
                str = str.replace('"Le Champ', "Le Champ")
                str = str.replace('"Le Champ', "Le Champ")
                str = str.replace('"Le Champ', "Le Champ")
                str = str.split(',')

                this.errors = str
                console.log(this.errors)
                // this.errors = error.response
                // console.log(this.errors.data)
            });
        },
        onSelect({name, iso2, dialCode}) {
            console.log(name, iso2, dialCode);

            this.form.dial_code = dialCode
        }
    }
}
</script>

<style scoped>
.dial_code{
    height: 100%;
}
</style>