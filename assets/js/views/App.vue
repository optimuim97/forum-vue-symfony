<template>
    <v-app> 
        <v-main>
            <v-container fluid>
                <router-view>
                    <router-link to="Home">Home</router-link>
                    <router-link to="Login">Login</router-link>
                    <router-link to="Register">Register</router-link>
                </router-view>
            </v-container>
        </v-main>
    </v-app>
</template>
<script>
export default {
    name: "App"
}
</script>

<style scoped>

</style>