<template>
  <div>
    <v-card
      tile
    >
      <v-toolbar>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer">
        </v-app-bar-nav-icon>

        <v-toolbar-title text="upper">
            ForumApp
        </v-toolbar-title>

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
    <v-navigation-drawer
      v-model="drawer"
      absolute
      bottom
      temporary
    >

      <v-list>
        <v-list-item-group v-model="group">
          <v-list-item
            v-for="item in items"
            :key="item.title" :to="item.to"
          >
            <!-- <v-list-item-icon> -->
              <!-- <v-icon v-text="item.icon"></v-icon> -->
            <!-- </v-list-item-icon> -->
            <v-list-item-content>
                <v-list-item-title v-text="item.title" v-if="item.show">
                </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>

    </v-navigation-drawer>
  </div>
</template>

<script>
    
    export default {
        data(){
          return {
              items : [
                { title : "Forum", to: '/forum', show : User.loggIn() },
                { title : "Ajouter Article", to: '/create', show : User.loggIn() },
                { title : "Mon Profil", to: '/profil', show : ( User.loggIn() ) },
                { title : "Déconnexion", to: '/logout', show : User.loggIn() },
                { title : "Se Connecté", to: '/login', show : ! ( User.loggIn() ) }
              ],
              drawer: false,
              group: null
          }
        },
        watch: {
          group () {
            this.drawer = false
          },
        },
        created(){
          EventBus.$on('logout', () => {
              User.logout();
              this.$toastr('info', 'Déconnexion éffectué !', 'Super ! ✔️')

          }) 
         ,
          EventBus.$on('login', () => {
              this.$router.push({path: '/forum' })

              this.items = [
                { title : "Forum", to: '/forum', show : User.loggIn() },
                { title : "Ajouter Article", to: '/create', show : User.loggIn() },
                { title : "Mon Profil", to: '/profil', show : User.loggIn() },
                { title : "Déconnexion", to: '/logout', show : User.loggIn() },
                { title : "Se Connecté", to: '/login', show : ! (User.loggIn()) },
              ]

          })
        }
    }
</script>
