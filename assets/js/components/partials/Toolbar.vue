<template>
  <v-card
    tile
  >
    <v-toolbar>
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title text="upper">ForumApp</v-toolbar-title>

      <v-spacer></v-spacer>
          <div
              class="hidden-sm-and-down"
          > 
            <router-link v-for="item in items" :key="item.title" :to="item.to">
              <v-btn text  v-if="item.show"> {{item.title}} </v-btn>
            </router-link>

          </div>
    </v-toolbar>
  </v-card>
</template>

<script>
    
    export default {
        data(){
          return {
              items : [
                { title : "Forum", to: '/forum', show : User.loggIn() },
                { title : "Ajouter Article", to: '/create', show : User.loggIn() },
                { title : "Se Connecté", to: '/login', show : ! ( User.loggIn() ) },
                { title : "Déconnexion", to: '/logout', show : User.loggIn() }
              ]
          }
        },
        created(){
          EventBus.$on('logout', () => {
              User.logout();
              this.$toastr('info', 'You are logout', 'Good')

          }) 
          // ,
          EventBus.$on('login', () => {
            this.$router.push({path: '/forum' })

            this.items = [
              { title : "Forum", to: '/forum', show : User.loggIn() },
              { title : "Ajouter Article", to: '/create', show : User.loggIn() },
              { title : "Se Connecté", to: '/login', show : ! ( User.loggIn() ) },
              { title : "Déconnexion", to: '/logout', show : User.loggIn() }
            ]
          })
        }
    }
</script>
